<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Organization_type;
use App\ParentChildOrganizations;
use App\State;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;


class OrganizationController extends Controller
{

    public function index()
    {
        $childOrganizations = ParentChildOrganizations::where('parent_org_id', '=', Auth::user()->organization_id)->get();
        $count = $childOrganizations->count();
        $subscriptiondb = DB::table('subscriptions')->where('organization_id', Auth::user()->organization_id)->value('quantity');
        $subscription = $subscriptiondb - 1;

        return view('organizations.index', compact('childOrganizations', 'count', 'subscriptiondb', 'subscription'));

    }

    public function edit($id)
    {
        $organization=Organization::find($id);
        $states = State::pluck('state_name', 'state_code');
        $Organization_types = Organization_type::pluck('type_name', 'id');
        return view('organizations.edit', compact('organization', 'states', 'Organization_types'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|regex:/[0-9]{9}/',
            'zipcode' => 'required|regex:/[0-9]{5}/',
            'state' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect() ->back()->withErrors($validator)->withInput();
        }

        $organizationUpdate = $request->all();
        Organization::find($id)->update($organizationUpdate);
        return redirect('organizations');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'org_name' => 'required|string|max:255',
            'organization_type_id' => 'required',
            'street_address1' => 'required|string|max:255',
            'street_address2' => 'string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required',
            'phone_number' => 'required',

            /*'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|string|min:6|',*/
        ]);
    }

    public function createOrganization() {
        $states = State::pluck('state_name', 'state_code');
        $Organization_types = Organization_type::pluck('type_name', 'id');
        return view('organizations.create', compact('states', 'Organization_types'));
    }

    /**
     * Creating a new Organization
     *
     * @param Request $request
     * @return mixed
     */
    protected function create(Request $request)
    {
        /*return Validator::make($request->all(), [
            'org_name' => 'required|string|max:255',
            'organization_type_id' => 'required',
            'street_address1' => 'required|string|max:255',
            'street_address2' => 'string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipcode' => 'required',
            'phone_number' => 'required',
        ]);*/

        // Add validation
        $organization = new Organization;
        $organization->org_name = $request['org_name'];
        $organization->org_description = $request['org_description'];
        $organization->organization_type_id = Auth::user()->organization->organizationType->id;
        $organization->street_address1 = $request['street_address1'];
        $organization->street_address2 = $request['street_address2'];
        $organization->city = $request['city'];
        $organization->state = $request['state'];
        $organization->zipcode = $request['zipcode'];
        $organization->phone_number = $request['phone_number'];
        $organization->save();

        // Inserting the relation between parent organization and child organization
        ParentChildOrganizations::create(['parent_org_id' => Auth::user()->organization_id, 'child_org_id' => $organization->id]);

        //$childOrganizations = ParentChildOrganizations::where('parent_org_id', '=', Auth::user()->organization_id)->get();
        return redirect()->route("organizations.index")->with('message','Successfully added the Business Location');
    }

    public function destroy($id) {
        $organization = ParentChildOrganizations::where('child_org_id', '=', $id);
        $organization->delete();
        return redirect()->back()->with('message', 'Successfully deleted the Business Location');
    }
// include organization id in the donation request URL//


}
