<?php

namespace App\Http\Controllers;

use App\DonationRequest;
use App\Organization;
use App\ParentChildOrganizations;
use App\Rule;
use App\Rule_type;
use Auth;
use App\Events\SendAutoRejectEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\withErrors;
use Illuminate\Support\Facades\DB;
use Psy\Command\ListCommand\Enumerator;
use timgws\QueryBuilderParser;

//use Illuminate\Database\Eloquent\Builder;
// use timgws\JoinSupportingQueryBuilderParser;


//////////////////////////////  T0D0 ITEMS  //////////////////////////////
//
// TODO: Simplify Rule execution: a lot of redundant code in running rules that could be consolidated with some work.
// TODO: Beautify UI for updating days notice and monthly budget
// TODO: Decide what to do with loadRules function
//
//////////////////////////////  END T0D0  //////////////////////////////


//////////  CONSTANTS USED IN CONTROLLER  //////////
// APPROVAL STATUSES
const SUBMITTED = 1;
const PENDING_REJECTION = 2;
const PENDING_APPROVAL = 3;
const REJECTED = 4;
const APPROVED = 5;

// RULE TYPES
const AUTO_REJECT_RULE = 1;
const PRE_APPROVE_RULE = 2;

// ACTIVE FLAGS
const ACTIVE = 1;
const INACTIVE = 0;
//////////  END OF CONSTANTS USED  //////////
///
class RuleEngineController extends Controller
{
    ///////////  LOAD RULES PAGE  //////////
    public function index(Request $request)
    {
        // dd($request);
        $rule_types = Rule_type::where('active', '=', ACTIVE)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $organization = Organization::findOrFail($orgId);
        $monthlyBudget = $organization->monthly_budget;
        $daysNotice = $organization->required_days_notice;
        $ruleType = $request->rule ?? AUTO_REJECT_RULE;
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $orgId], ['rule_type_id', '=', $ruleType], ['active', '=', true]])->first();
        //dd($ruleRow);
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
        } else {
            $queryBuilderJSON = ''; //'{"condition": "AND", "rules": [{}], "not": false, "valid": true }';
        }
        //dd($queryBuilderJSON);
        return view('rules.rules')->with('rule', $queryBuilderJSON)->with('rule_types', $rule_types)->with('ruleType', $ruleType)
            ->with('monthlyBudget', $monthlyBudget)->with('daysNotice', $daysNotice);
    }

    public function loadRule($request)  // Redundant with index.. Remove or rebuild to be used by index?
    {
        $rule_types = Rule_type::where('active', '=', ACTIVE)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $ruleType = $request->rule ?? AUTO_REJECT_RULE;
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $orgId], ['rule_type_id', '=', $ruleType], ['active', '=', true]])->first();
        //dd($ruleRow);
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
        } else {
            $queryBuilderJSON = ''; //'{"condition": "AND", "rules": [{}], "not": false, "valid": true }';
        }
        //dd($queryBuilderJSON);
    }

    ///////////  SAVE SELECTED RULE TO DB  //////////
    public function saveRule(Request $request)
    {
        $strJSON = $request->ruleSet;
        $ruleType = $request->ruleType;
        $ruleOwner = Auth::user()->organization_id;
        //dd($strJSON);
        /*$rule = new Rule;
        $rule->rule_type_id = 2;
        $rule->rule_owner_id = Auth::user()->organization_id;
        $rule->rule = $strJSON;*/
        Rule::updateOrCreate(['rule_owner_id' => $ruleOwner, 'rule_type_id' => $ruleType], ['rule' => $strJSON]);
        return redirect()->back();
    }

    ///////////  SAVE BUDGET AND DAYS NOTICE FOR ORG (BUSINESS)  //////////
    public function saveBudgetNotice(Request $request)
    {
        //
        $monthlyBudget = $request->monthlyBudget;
        $daysNotice = $request->daysNotice;

        $orgId = Auth::user()->organization_id;
        $organization = Organization::findOrFail($orgId);
        $organization->monthly_budget = $monthlyBudget;
        $organization->required_days_notice = $daysNotice;
        $organization->save();
        return redirect()->back();
    }

    //////////  AUTO CATEGORIZATION OF REQUESTS ON SUBMIT OF REQUEST  //////////
    public function runRuleOnSubmit(DonationRequest $donationRequest)
    {
        // This will execute the rule workflow for a donation request using the rules of the organization it was submitted to.
        $parentOrg = ParentChildOrganizations::query()->where('child_org_id', $donationRequest->organization_id)->get(['parent_org_id'])->first();
        If ($parentOrg) {
            $ruleOwner = $parentOrg->parent_org_id;
        } else {
            $ruleOwner = $donationRequest->organization_id;
        }
        $this->runAutoRejectOnSubmit($donationRequest, $ruleOwner);
        $this->runPendingApprovalOnSubmit($donationRequest, $ruleOwner);
        $this->runPendingRejectionOnSubmit($donationRequest);
    }

    protected function runAutoRejectOnSubmit(DonationRequest $donationRequest, $ruleOwner)
    {
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', AUTO_REJECT_RULE], ['active', '=', ACTIVE]])->first();
        if ($ruleRow) {
            $table = DB::table('donation_requests');
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON, true);
            $arr = $this->filteredQueryBuilderJsonArray($json, $donationRequest->id, false);
            $qbp = new QueryBuilderParser(
                ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($arr), $table);
            //dd($query->get());
            $exists = $query->get(['id']);
            if ($exists->isNotEmpty()) {
                // Apply Rule
                $query->update(['approval_status_id' => REJECTED, 'approved_organization_id' => $ruleOwner, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        }
    }

    protected function runPendingApprovalOnSubmit(DonationRequest $donationRequest, $ruleOwner)
    {
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', PRE_APPROVE_RULE], ['active', '=', ACTIVE]])->first();
        if ($ruleRow) {
            $table = DB::table('donation_requests');
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON, true);
            $arr = $this->filteredQueryBuilderJsonArray($json, $donationRequest->id, false);
            $qbp = new QueryBuilderParser(
                ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($arr), $table);
            //dd($query->get());
            $exists = $query->get(['id']);
            if ($exists->isNotEmpty()) {
                // Apply Rule
                $query->update(['approval_status_id' => PENDING_APPROVAL, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        }
    }

    protected function runPendingRejectionOnSubmit(DonationRequest $donationRequest)
    {
        //Flag all requests that do not meet either of the previous two rules as ready for rejection
        $query = DB::table('donation_requests')->where([['id', '=', $donationRequest->id], ['approval_status_id', '=', SUBMITTED]]);
        $exists = $query->get(['id']);
        if ($exists->isNotEmpty()) {
            $query->update(['approval_status_id' => PENDING_REJECTION, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }

    //////////  CATEGORIZATION OF ALL SUBMITTED REQUESTS ON REQUEST (manual process)  //////////
    public function manualRunRule(Request $request)
    {
        $ruleOwner = Auth::user()->organization_id;
        $orgIdArray = ParentChildOrganizations::where('parent_org_id', $ruleOwner)->pluck('child_org_id')->toArray();
        array_push($orgIdArray, $ruleOwner);
        $this->manualRunAutoRejectRule($ruleOwner, $orgIdArray);
        $this->manualRunPendingApprovalRule($ruleOwner, $orgIdArray);
        $this->manualRunPendingRejectionRule($orgIdArray);

        return redirect()->to('/donationrequests'); //->back(); //->with('msg', Response::JSON($rows));
    }

    protected function manualRunAutoRejectRule($ruleOwner, $orgIdsFilteredArray)
    {
        $table = DB::table('donation_requests');
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', AUTO_REJECT_RULE], ['active', '=', ACTIVE]])->first();
        if ($ruleRow) {
            DB::enableQueryLog();
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON, true);
            $arr = $this->filteredQueryBuilderJsonArray($json, $orgIdsFilteredArray);
            $qbp = new QueryBuilderParser(
                ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($arr, JSON_UNESCAPED_SLASHES), $table);
            $query->update(['approval_status_id' => REJECTED, 'approved_organization_id' => $ruleOwner, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::tomorrow()]);
        }
    }

    protected function manualRunPendingApprovalRule($ruleOwner, $orgIdsFilteredArray)
    {
        $table = DB::table('donation_requests');
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', PRE_APPROVE_RULE], ['active', '=', ACTIVE]])->first();
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON, true);
            $arr = $this->filteredQueryBuilderJsonArray($json, $orgIdsFilteredArray);
            $qbp = new QueryBuilderParser(
                ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($arr), $table);
            $query->update(['approval_status_id' => PENDING_APPROVAL, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }

    protected function manualRunPendingRejectionRule($orgIdsFilteredArray)
    {
        $query = DB::table('donation_requests')->where('approval_status_id', '=', SUBMITTED)->whereIn('organization_id', $orgIdsFilteredArray);
        $exists = $query->get(['id']);
        if ($exists->isNotEmpty()) {
            $query->update(['approval_status_id' => PENDING_REJECTION, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }


    //////////  QUERYBUILDER BUSINESS RULES AUGMENTED WITH ORGANIZATION SPECIFIC FILTERING  //////////
    protected function filteredQueryBuilderJsonArray(Array $jsonArray, $iD, $isOrgId = true)
    {
        $array['condition'] = 'AND';
        $array['not'] = 'false';
        $array['rules'][0]['field'] = 'approval_status_id';
        $array['rules'][0]['id'] = 'approval_status_id';
        $array['rules'][0]['input'] = 'text';
        $array['rules'][0]['operator'] = 'equal';
        $array['rules'][0]['type'] = 'integer';
        $array['rules'][0]['value'] = SUBMITTED;
        if ($isOrgId) {
            $array['rules'][1]['field'] = 'organization_id';
            $array['rules'][1]['id'] = 'organization_id';
            $array['rules'][1]['input'] = 'text';
            $array['rules'][1]['operator'] = 'in';
            $array['rules'][1]['type'] = 'integer';
            $array['rules'][1]['value'] = $iD;
        } else {
            $array['rules'][1]['field'] = 'id';
            $array['rules'][1]['id'] = 'id';
            $array['rules'][1]['input'] = 'text';
            $array['rules'][1]['operator'] = 'equal';
            $array['rules'][1]['type'] = 'integer';
            $array['rules'][1]['value'] = $iD;

        }
        array_push($array['rules'], $jsonArray);

        return $array;
    }

    //////////  REJECTS REQUESTS THAT WOULD PUT ORGANIZATION OVER BUDGET FOR REQUESTED MONTH (called via cron job)  //////////
    public function runBudgetCheckRule()
    {
        // Get Active organizations
        $organizations = Organization::query()->where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->get(['id', 'monthly_budget']);
        //dd($organizations);
        foreach ($organizations as $organization) {
            $monthlyBudget = $organization->monthly_budget;
            //dd($monthlyBudget);
            // Only run Budget rule if it is greater than zero
            if ($monthlyBudget > 0) {
                $amountSpent = DonationRequest::query()->whereMonth('needed_by_date', '=', Carbon::today()->month)->whereYear('needed_by_date', '=', Carbon::today()->year)
                    ->where('approved_organization_id', '=', $organization->id)->where('approval_status_id', '=', APPROVED)
                    ->sum('approved_dollar_amount');
                //dd($amountSpent);
                $pendingDonationRequests = DonationRequest::query()->where('organization_id', '=', $organization->id)->whereIn('approval_status_id', [SUBMITTED, PENDING_APPROVAL])
                    ->whereMonth('needed_by_date', '=', Carbon::today()->month)->whereYear('needed_by_date', '=', Carbon::today()->year)->get();
                foreach ($pendingDonationRequests as $donationRequest) {
                    $requestAmount = $donationRequest->dollar_amount;
                    If (($requestAmount + $amountSpent) >= $monthlyBudget) {
                        Info('Donation Request ID has been Rejected: ' . $donationRequest->id);
                        // pending-reject each request that would put organization over budget
                        $donationRequest->approval_status_id = PENDING_REJECTION;
                        //$donationRequest->approved_organization_id = $organization->id;
                        $donationRequest->rule_process_date = Carbon::now();
                        $donationRequest->save();
                    }
                }
            }
        }
        return redirect()->to('/donationrequests'); //->back();
    }

    //////////  REJECTS REQUESTS WHERE NEEDED BY IS SOONER THAN MIN NOTICE (called via cron job)  //////////
    public function runMinimumNoticeCheckRule()
    {
        // Get Active organizations
        $organizations = Organization::query()->where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->get(['id']);

        foreach ($organizations as $organization) {
            $requiredDaysNotice = Organization::query()->where('id', '=', $organization->id)->get(['required_days_notice'])->first()->required_days_notice;
            // Only run Budget rule if it is greater than zero
            info('Required Days Notice: ' . $requiredDaysNotice);
            if ($requiredDaysNotice > 0) {
                $pendingDonationRequests = DonationRequest::query()->where('organization_id', '=', $organization->id)
                    ->whereIn('approval_status_id', [SUBMITTED, PENDING_REJECTION, PENDING_APPROVAL])->get();
                info('Pending Donation Requests: \n ' . $pendingDonationRequests);
                foreach ($pendingDonationRequests as $donationRequest) {
                    $requestNeededBy = $donationRequest->needed_by_date;
                    info('Required Days Notice: ' . $requiredDaysNotice);
                    If (Carbon::today()->addDays($requiredDaysNotice) >= $requestNeededBy) {
                        // auto-reject each request that is needed before the organization can deliver
                        Info('Request Rejected ID: ' . $donationRequest->id);
                        $donationRequest->approval_status_id = REJECTED;
                        $donationRequest->approved_organization_id = $organization->id;
                        $donationRequest->rule_process_date = Carbon::now();
                        $donationRequest->save();
                        event(new SendAutoRejectEmail($donationRequest));
                        usleep(500000);
                    }
                }
            }
        }
        return redirect()->to('/donationrequests'); //->back();
    }

    ///////////  OPEN HELP PAGE  //////////
    public function rulesHelp()
    {
        return view('rules.help');
    }
}
