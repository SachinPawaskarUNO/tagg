<?php

namespace App\Http\Controllers;

use App\DonationRequest;
use App\Organization;
use App\ParentChildOrganizations;
use App\Rule;
use App\Rule_type;
use App\Requester_type;
use App\Request_item_type;
use Auth;
use App\Events\SendAutoRejectEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\withErrors;
use Illuminate\Support\Facades\DB;
use Psy\Command\ListCommand\Enumerator;
use timgws\QueryBuilderParser;
use App\Custom\Constant;

//use Illuminate\Database\Eloquent\Builder;
// use timgws\JoinSupportingQueryBuilderParser;


//////////////////////////////  T0D0 ITEMS  //////////////////////////////
//
// TODO: Simplify Rule execution: a lot of redundant code in running rules that could be consolidated with some work.
// TODO: Decide what to do with loadRules function
//
//////////////////////////////  END T0D0  //////////////////////////////

class RuleEngineController extends Controller
{
    ///////////  LOAD RULES PAGE  //////////
    public function index(Request $request)
    {
        $rule_types = Rule_type::where('active', '=', Constant::ACTIVE)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $organization = Organization::findOrFail($orgId);
        $monthlyBudget = $organization->monthly_budget;
        $daysNotice = $organization->required_days_notice;
        $ruleType = $request->rule ?? Constant::AUTO_REJECT_RULE;
        $requesterTypes = $this->getRequesterType();
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $orgId]])->first();
        // dd($ruleRow);
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
        } else {
            $queryBuilderJSON = ''; //'{"condition": "AND", "rules": [{}], "not": false, "valid": true }';
        }
        // send organization type and dontaion type fields 
        // for ($ruleRow->orgTypes)
        // $ot =  json_decode($ruleRow->orgtype);
        // dd($ot);
        // $reqTypes = DB::table('Requester_types')->whereIn('id', json_decode($ruleRow->orgtype))->get();
        $reqTypes = Requester_type::all();
        $reqItemTypes = Request_item_type::all();
        return view('rules.rules')->with('rule', $queryBuilderJSON)->with('rule_types', $rule_types)->with('ruleType', $ruleType)
            ->with('monthlyBudget', $monthlyBudget)->with('daysNotice', $daysNotice)->with('rs', $reqTypes)
            ->with('reqItemTypes', $reqItemTypes)
            ->with('orgId', $orgId)
            ->with('ruleRow', $ruleRow);
    }


    ///////////  FORMAT LIST FOR REQUESTER TYPES  //////////
    protected function getRequesterType()
    {
        // creates string for types of requesters for the querybuilder api
        $requesterTypes = Requester_type::where('active', '=', Constant::ACTIVE)->get(['id', 'type_name']);
        $formattedStrings = '';
        foreach ($requesterTypes as $requesterType) {
            $formattedStrings = $formattedStrings . $requesterType->id . ': \'' . $requesterType->type_name . '\', ';
        }
        return substr($formattedStrings, 0, strlen($formattedStrings) - 2);
    }

    ///////////  SAVE SELECTED RULE TO DB  //////////
    public function saveRule(Request $request)
    {
        $strJSON = $request->ruleSet;
        $ruleType = $request->ruleType;
        $ruleOwner = Auth::user()->organization_id;
        Rule::updateOrCreate(['rule_owner_id' => $ruleOwner, 'rule_type_id' => $ruleType], ['rule' => $strJSON]);
        return redirect()->back();
    }

    // ///////////  SAVE BUDGET AND DAYS NOTICE FOR ORG (BUSINESS)  //////////
    // public function saveBudgetNotice(Request $request)
    // {
    //     //
    //     dd($request);
    //     $monthlyBudget = preg_replace('/[,]/', '', $request->monthlyBudget);
    //     $daysNotice = $request->daysNotice;

    //     $orgId = Auth::user()->organization_id;
    //     $organization = Organization::findOrFail($orgId);
    //     $organization->monthly_budget = $monthlyBudget;
    //     $organization->required_days_notice = $daysNotice;
    //     $organization->save();
    //     return redirect()->back();
    // } no more required 

    //////////  AUTO CATEGORIZATION OF REQUESTS ON SUBMIT OF REQUEST  //////////
    public function runRuleOnSubmit(DonationRequest $donationRequest)
    {
        // This will execute the rule workflow for a donation request using the rules of the organization it was Constant::SUBMITTED to.
        $parentOrg = ParentChildOrganizations::active()->where('child_org_id', $donationRequest->organization_id)->get(['parent_org_id'])->first();
        If ($parentOrg) {
            $ruleOwner = $parentOrg->parent_org_id;
        } else {
            $ruleOwner = $donationRequest->organization_id;
        }
        //  dd($donationRequest);
        $this->runAutoRejectOnSubmit($donationRequest, $ruleOwner);
        // $this->runPendingApprovalOnSubmit($donationRequest, $ruleOwner);
        // $this->runPendingRejectionOnSubmit($donationRequest);
    }

    protected function runAutoRejectOnSubmit(DonationRequest $donationRequest, $ruleOwner)
    {
        
        $ruleRow = Rule::query()->where([['rule_owner_id', '=',  $donationRequest->organization_id], ['active', '=', Constant::ACTIVE]])->first();
        if ($ruleRow) {
            // $dreq = DB::table('donation_requests')->where(id);
            if ($ruleRow->amtreq == 0) {
                // return $ruleRow->amtreq;
                $ruleRow->amtreq = $donationRequest->dollar_amount;
            }
            if ($ruleRow->orgtype == null) {
                // return $ruleRow->amtreq;
                $ruleRow->amtreq = $donationRequest->dollar_amount;
            }
            $donationRequest->tax_exempt = true;
            $dreq = DB::table('donation_requests')->where('id', $donationRequest->id)->first();
            if (
                ($ruleRow->orgtype == null || in_array($donationRequest->requester_type, $ruleRow->orgtype)
                ) 
            && 
                (
                $ruleRow->dntype == null || in_array($donationRequest->item_requested, $ruleRow->dntype)
                ) && 
                ($donationRequest->tax_exempt == $ruleRow->taxex || $donationRequest->tax_exempt == true ) &&
                $donationRequest->dollar_amount <= $ruleRow->amtreq) {
                
                // update to auto approved.

                $chk = DB::table('donation_requests')->where('id', $donationRequest->id)
                ->update(['approval_status_id' => Constant::PENDING_APPROVAL,
                          'approval_status_reason' => 'Pending Approval',
                          'rule_process_date' => Carbon::now(),
                          'updated_at' => Carbon::now()
                          ]);
                
                // $chk = " yes match";
                // return $chk;
            } else {
                    $ex = (
                    (!in_array($donationRequest->requester_type,$ruleRow->orgtype)) ? "Pending Rejection - Organization Type" :
                        ((!in_array($donationRequest->item_requested, $ruleRow->dntype)) ? "Pending rejection - Donation Type" :
                            (($donationRequest->tax_exempt !== $ruleRow->taxex) ? "Pending Rejection - Not 501c3" :
                                (($donationRequest->dollar_amount > $ruleRow->amtreq) ? "Pending Rejection - Exceeded Amount" : "Others")))
                    );
                $chk = DB::table('donation_requests')->where('id', $donationRequest->id)
                ->update(['approval_status_id' => Constant::PENDING_REJECTION,
                          'approval_status_reason' => $ex,
                          'rule_process_date' => Carbon::now(),
                          'updated_at' => Carbon::now()
                          ]);
                // $chk = "no match";
                // return $chk;            
            }
            // $queryBuilderJSON = $ruleRow->rule;
            // $json = json_decode($queryBuilderJSON, true);
            // $arr = $this->filteredQueryBuilderJsonArray($json, $donationRequest->id, false);
            // $qbp = new QueryBuilderParser(
            //     ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            // );
            // $query = $qbp->parse(json_encode($arr), $table);
            // $exists = $query->get(['id']);
            // if ($exists->isNotEmpty()) {
            //     // Apply Rule
            //     $query->update(['approval_status_id' => Constant::REJECTED, 'approval_status_reason' => $ruleRow->ruleType->type_name . ' Rule',
            //         'approved_organization_id' => $ruleOwner, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
            }
        }

        protected function runPendingApprovalOnSubmit(DonationRequest $donationRequest, $ruleOwner)
        {
            $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', Constant::PRE_APPROVE_RULE], ['active', '=', Constant::ACTIVE]])->first();
            if ($ruleRow) {
                $table = DB::table('donation_requests');
                $queryBuilderJSON = $ruleRow->rule;
                $json = json_decode($queryBuilderJSON, true);
                $arr = $this->filteredQueryBuilderJsonArray($json, $donationRequest->id, false);
                $qbp = new QueryBuilderParser(
                    ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
                );
                $query = $qbp->parse(json_encode($arr), $table);
                $exists = $query->get(['id']);
                if ($exists->isNotEmpty()) {
                    // Apply Rule
                    $query->update(['approval_status_id' => Constant::PENDING_APPROVAL, 'approval_status_reason' => $ruleRow->ruleType->type_name . ' Rule', 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
                }
            }
        }    

    protected function runPendingRejectionOnSubmit(DonationRequest $donationRequest)
    {
        //Flag all requests that do not meet either of the previous two rules as ready for rejection
        $query = DB::table('donation_requests')->where([['id', '=', $donationRequest->id], ['approval_status_id', '=', Constant::SUBMITTED]]);
        $exists = $query->get(['id']);
        if ($exists->isNotEmpty()) {
            $query->update(['approval_status_id' => Constant::PENDING_REJECTION, 'approval_status_reason' => 'Failed Pre-Accept Rule', 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }


    protected function store(Request $request)
    {
        // dd($request);
        $orgId = Auth::user()->organization_id;
        $rl = Rule::where([['rule_owner_id', '=', $orgId]])->first();
        // dd($request->taxex);
        // $rl->orgtype = json_encode($request->orgTypeId);
        $rl->orgtype = $request->orgTypeId;
        $rl->dntype = $request->dtypeId;
        // $rl->dntype = json_encode($request->dtypeId);
        $rl->taxex = $request->taxex;
        $rl->amtreq = $request->amtReq;
        $rl->update($request->all());
        
        // save budget and notice days
        $orgrow = Organization::findOrFail($orgId);
        $orgrow->monthly_budget = $request->monthlyBudget;
        $orgrow->required_days_notice = $request->noticeDays;
        $orgrow->update();
        // return redirect('rules/');
        return redirect()->back()->with('message', 'Donation preferences have been saved successfully !');
    }

    //////////  CATEGORIZATION OF ALL Constant::SUBMITTED REQUESTS ON REQUEST (manual process)  //////////
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
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', Constant::AUTO_REJECT_RULE], ['active', '=', Constant::ACTIVE]])->first();
        if ($ruleRow) {
            DB::enableQueryLog();
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON, true);
            $arr = $this->filteredQueryBuilderJsonArray($json, $orgIdsFilteredArray);
            $qbp = new QueryBuilderParser(
                ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($arr, JSON_UNESCAPED_SLASHES), $table);
            $query->update(['approval_status_id' => Constant::REJECTED, 'approval_status_reason' => $ruleRow->ruleType->type_name . ' Rule',
                'approved_organization_id' => $ruleOwner, 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::tomorrow()]);
        }
    }

    protected function manualRunPendingApprovalRule($ruleOwner, $orgIdsFilteredArray)
    {
        $table = DB::table('donation_requests');
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', Constant::PRE_APPROVE_RULE], ['active', '=', Constant::ACTIVE]])->first();
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON, true);
            $arr = $this->filteredQueryBuilderJsonArray($json, $orgIdsFilteredArray);
            $qbp = new QueryBuilderParser(
                ['id', 'organization_id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($arr), $table);
            $query->update(['approval_status_id' => Constant::PENDING_APPROVAL, 'approval_status_reason' => $ruleRow->ruleType->type_name . ' Rule', 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }

    protected function manualRunPendingRejectionRule($orgIdsFilteredArray)
    {
        $query = DB::table('donation_requests')->where('approval_status_id', '=', Constant::SUBMITTED)->whereIn('organization_id', $orgIdsFilteredArray);
        $exists = $query->get(['id']);
        if ($exists->isNotEmpty()) {
            $query->update(['approval_status_id' => Constant::PENDING_REJECTION, 'approval_status_reason' => 'Failed Pre-Accept Rule', 'rule_process_date' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }


    //////////  QUERYBUILDER BUSINESS RULES AUGMENTED WITH ORGANIZATION SPECIFIC FILTERING  //////////
    /* appends global filters based on organization or specific request
     * @jsonArray - Business Rule stored on DB that is in an editiable format
     * @iD - Business ID or ID of Donation Request, depending on @isOrgId
     * @isOrgId - denotes if ID passed is the ID of the business or the donation request
     * (manual execution of rule vs on submit)
     */
    protected function filteredQueryBuilderJsonArray(Array $jsonArray, $iD, $isOrgId = true)
    {
        $array['condition'] = 'AND';
        $array['not'] = 'false';
        $array['rules'][0]['field'] = 'approval_status_id';
        $array['rules'][0]['id'] = 'approval_status_id';
        $array['rules'][0]['input'] = 'text';
        $array['rules'][0]['operator'] = 'equal';
        $array['rules'][0]['type'] = 'integer';
        $array['rules'][0]['value'] = Constant::SUBMITTED;
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
        // Get Constant::ACTIVE organizations
        $organizations = Organization::query()->where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->get(['id', 'monthly_budget']);

        foreach ($organizations as $organization) {
            $monthlyBudget = $organization->monthly_budget;

            // Only run Budget rule if it is greater than zero
            if ($monthlyBudget > 0) {
                $amountSpent = DonationRequest::query()->whereMonth('needed_by_date', '=', Carbon::today()->month)->whereYear('needed_by_date', '=', Carbon::today()->year)
                    ->where('approved_organization_id', '=', $organization->id)->where('approval_status_id', '=', Constant::APPROVED)
                    ->sum('approved_dollar_amount');

                $pendingDonationRequests = DonationRequest::query()->where('organization_id', '=', $organization->id)->whereIn('approval_status_id', [Constant::SUBMITTED, Constant::PENDING_APPROVAL])
                    ->whereMonth('needed_by_date', '=', Carbon::today()->month)->whereYear('needed_by_date', '=', Carbon::today()->year)->get();

                foreach ($pendingDonationRequests as $donationRequest) {
                    $requestAmount = $donationRequest->dollar_amount;
                    If (($requestAmount + $amountSpent) >= $monthlyBudget) {
                        Info('Donation Request ID has been Constant::REJECTED: ' . $donationRequest->id);
                        // pending-reject each request that would put organization over budget
                        $donationRequest->approval_status_id = Constant::PENDING_REJECTION;
                        $donationRequest->approval_status_reason = 'Would Exceed Monthly Budget';
                        //$donationRequest->approved_organization_id = $organization->id;
                        $donationRequest->rule_process_date = Carbon::now();
                        $donationRequest->save();
                    }
                }
            }
        }
        return redirect()->to('/donationrequests');
    }

    //////////  REJECTS REQUESTS WHERE NEEDED BY IS SOONER THAN MIN NOTICE (called via cron job)  //////////
    public function runMinimumNoticeCheckRule()
    {
        // Get ACTIVE organizations
        $organizations = Organization::query()->where('trial_ends_at', '>=', Carbon::now()->toDateTimeString())->get(['id']);

        foreach ($organizations as $organization) {
            $requiredDaysNotice = Organization::query()->where('id', '=', $organization->id)->get(['required_days_notice'])->first()->required_days_notice;
            // Only run Budget rule if it is greater than zero
            info('Required Days Notice: ' . $requiredDaysNotice);
            if ($requiredDaysNotice > 0) {
                $pendingDonationRequests = DonationRequest::query()->where('organization_id', '=', $organization->id)
                    ->whereIn('approval_status_id', [Constant::SUBMITTED, Constant::PENDING_REJECTION, Constant::PENDING_APPROVAL])->get();
                info('Pending Donation Requests: \n ' . $pendingDonationRequests);
                foreach ($pendingDonationRequests as $donationRequest) {
                    $requestNeededBy = $donationRequest->needed_by_date;
                    info('Required Days Notice: ' . $requiredDaysNotice);
                    If (Carbon::today()->addDays($requiredDaysNotice) >= $requestNeededBy) {
                        // auto-reject each request that is needed before the organization can deliver
                        Info('Request REJECTED ID: ' . $donationRequest->id);
                        $donationRequest->approval_status_id = Constant::REJECTED;
                        $donationRequest->approval_status_reason = 'Needed by Date sooner than can be delivered';
                        $donationRequest->approved_organization_id = $organization->id;
                        $donationRequest->rule_process_date = Carbon::now();
                        $donationRequest->save();
                        event(new SendAutoRejectEmail($donationRequest));
                        usleep(500000);
                    }
                }
            }
        }
        return redirect()->to('/donationrequests');
    }

    ///////////  OPEN HELP PAGE  //////////
    public function rulesHelp()
    {
        return view('rules.help');
    }
}
