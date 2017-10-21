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
use timgws\QueryBuilderParser;
// use timgws\JoinSupportingQueryBuilderParser;

class RuleEngineController extends Controller
{
    public function index(Request $request){
       // dd($request);
        $rule_types = Rule_type::where('active', '=', 1)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $ruleType = $request->rule ?? 1;
        $ruleRow = Rule::query()->where([['rule_owner_id','=', $orgId],['rule_type_id', '=', $ruleType],['active', '=', true]])->first();
        //dd($ruleRow);
        if ($ruleRow) {
            $queryBuilderJSON = $ruleRow->rule;
        }
        else {
            $queryBuilderJSON = ''; //'{"condition": "AND", "rules": [{}], "not": false, "valid": true }';
        }
        //dd($queryBuilderJSON);
        return view('rules.rules')->with('rule', $queryBuilderJSON)->with('rule_types', $rule_types)->with('ruleType', $ruleType);
    }
    public function loadRule(Request $request){
        dd($request);
        $rule_types = Rule_type::where('active', '=', 1)->pluck('type_name', 'id');
        $orgId = Auth::user()->organization_id;
        $ruleType = $request->rule ?? 1;

        //dd($ruleType);
        $ruleRow = Rule::query()->where([['rule_owner_id','=', $orgId],['rule_type_id', '=', $ruleType],['active', '=', true]])->first();
        $queryBuilderJSON = $ruleRow->rule;
        return redirect()->back()->with('rule', $queryBuilderJSON)->with('rule_types', $rule_types)->with('ruleType', $ruleType);
    }
    public function saveRule(Request $request){
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

    public function runRule(Request $request){
        // $strJSON = $request->ruleSet;
        if ($request->rule){
            $ruleType = $request->rule;
        }
        else {
            $ruleType = 1;
        }
        $ruleOwner = Auth::user()->organization_id;
        $table = DB::table('donation_requests')->where([['organization_id','=', $ruleOwner], ['approval_status_id', '=', 1]])->get();
        //dd($request);
        $ruleRow = Rule::query()->where([['rule_owner_id','=', $ruleOwner],['rule_type_id', '=', $ruleType]])->first();
        $queryBuilderJSON = $ruleRow->rule;
        //dd($queryBuilderJSON);
        $qbp = new QueryBuilderParser(
            ['id','requester','needed_by_date','tax_exempt','dollar_amount','approved_organization_id','approval_status_id']
        );
        //dd($queryBuilderJSON);
        //$query = DonationRequest::with('organizations','approval_statuses');
        $query = $qbp->parse($queryBuilderJSON,  $table);
        $rows = $query->update(['approval_status_id' => 2]);

        // dd($query);
        // dd($rows);
        // return view('rules.rules');
        return redirect()->back(); //->with('msg', Response::JSON($rows));
    }

    public function rulesGUI(){
        return view('rules.guirules');
    }
    // EXAMPLE ONLY
    function displayUserDatatable() {
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
    function getDonationData(Request $request){
        $queryBuilderJSON =  '{"condition": "AND", "rules": [], "not": false, "valid": true }';
        if(Input::has('querybuilder') && Input::get('querybuilder') != 'null')
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
