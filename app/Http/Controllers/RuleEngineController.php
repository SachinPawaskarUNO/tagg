<?php

namespace App\Http\Controllers;

use App\Rule_type;
use Auth;
use App\Rule;
use App\DonationRequest;
use App\User;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Http\withErrors;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
//use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Integer;
use Carbon\Carbon;
use timgws\QueryBuilderParser;

// use timgws\JoinSupportingQueryBuilderParser;

class RuleEngineController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        $rule_types = Rule_type::where('active', '=', 1)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $ruleType = $request->rule ?? 1;
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $orgId], ['rule_type_id', '=', $ruleType], ['active', '=', true]])->first();
        //dd($ruleRow);
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
        } else {
            $queryBuilderJSON = ''; //'{"condition": "AND", "rules": [{}], "not": false, "valid": true }';
        }
        //dd($queryBuilderJSON);
        return view('rules.rules')->with('rule', $queryBuilderJSON)->with('rule_types', $rule_types)->with('ruleType', $ruleType);
    }

    public function loadRule($request)
    {
        // dd($request);
        $rule_types = Rule_type::where('active', '=', 1)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $ruleType = $request->rule ?? 1;
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $orgId], ['rule_type_id', '=', $ruleType], ['active', '=', true]])->first();
        //dd($ruleRow);
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
        } else {
            $queryBuilderJSON = ''; //'{"condition": "AND", "rules": [{}], "not": false, "valid": true }';
        }
        //dd($queryBuilderJSON);
    }

    public function saveRule(Request $request)
    {
        //
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

    public function runRule(Request $request)
    {
        $ruleOwner = Auth::user()->organization_id;
        $this->runAutoRejectRule($ruleOwner);
        $this->runPendingApprovalRule($ruleOwner);
        $this->runPendingRejectionRule($ruleOwner);

        return redirect()->to('/donationrequests'); //->back(); //->with('msg', Response::JSON($rows));
    }

    protected function runAutoRejectRule($ruleOwner)
    {
        $table = DB::table('donation_requests');
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', 1], ['active', '=', 1]])->first();
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON);
            $qbp = new QueryBuilderParser(
                ['id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            $query = $qbp->parse(json_encode($json), $table)->where([['organization_id', '=', $ruleOwner], ['approval_status_id', '=', 1]]);
            //$rows =
            $query->update(['approval_status_id' => 4, 'approved_organization_id' => $ruleOwner, 'rule_process_date' => Carbon::now()]);
            //$rows = $query->get();
            //dd($query);
            //dd($rows);
        }
    }

    protected function runPendingApprovalRule($ruleOwner)
    {
        $table = DB::table('donation_requests');
        $ruleRow = Rule::query()->where([['rule_owner_id', '=', $ruleOwner], ['rule_type_id', '=', 2], ['active', '=', 1]])->first();
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
            $json = json_decode($queryBuilderJSON);
            $qbp = new QueryBuilderParser(
                ['id', 'requester', 'requester_type', 'needed_by_date', 'tax_exempt', 'dollar_amount', 'approved_organization_id', 'approval_status_id']
            );
            //dd(json_encode($json));
            $query = $qbp->parse(json_encode($json), $table)->where([['organization_id', '=', $ruleOwner], ['approval_status_id', '=', 1]]);
            //$rows =
            $query->update(['approval_status_id' => 3, 'rule_process_date' => Carbon::now()]);
            //$rows = $query->get();
            //dd($query);
            //dd($rows);
        }
    }

    protected function runPendingRejectionRule($ruleOwner)
    {
        $query = DB::table('donation_requests')->where([['organization_id', '=', $ruleOwner], ['approval_status_id', '=', 1]]);
        //$rows =
        $query->update(['approval_status_id' => 2, 'rule_process_date' => Carbon::now()]);
        //$rows = $query->get();
        //dd($query);
        //dd($rows);
    }

    public function rulesHelp()
    {
        return view('rules.help');
    }

    // EXAMPLE ONLY
    function displayUserDatatable()
    {
        /* builder is POST'd by the datatable */
        $queryBuilderJSON = Input::get('rules');
        $show_columns = array('id', 'user_name', 'email');
        $query = new QueryBuilderParser($show_columns);
        /** Illuminate/Database/Query/Builder $queryBuilder **/
        $queryBuilder = $query->parse(DB::table('users'));
        return Datatable::query($queryBuilder)
            ->showColumns($show_columns)
            ->orderColumns($show_columns)
            ->searchColumns($show_columns)
            ->make();
    }

    // WORK IN PROGRESS
    function getDonationData(Request $request)
    {
        $queryBuilderJSON = '{"condition": "AND", "rules": [], "not": false, "valid": true }';
        if (Input::has('querybuilder') && Input::get('querybuilder') != 'null')
            $queryBuilderJSON = Input::get('querybuilder');
        $show_columns = array(
            'event_type',
            'item_requested',
            'item_purpose',
            'tax_exempt',
            'requester_type',
            'requester'
        );
        $query = new QueryBuilderParser($show_columns);
        $Q = DonationRequest::with(
            'event_type',
            'item_requested',
            'item_purpose',
            'tax_exempt',
            'requester_type',
            'requester'
        );
        $queryBuilder = $query->parse($queryBuilderJSON, $Q);
        return Datatables::of($queryBuilder->get())->make(true);
    }
}
