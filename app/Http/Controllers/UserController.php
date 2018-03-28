<?php

namespace App\Http\Controllers;

use App\Custom\Constant;
use App\Events\AddDefaultTemplates;
use App\Events\NewBusiness;
use App\Events\NewSubBusiness;
use App\Http\Controllers\Route;
use App\Organization;
use App\ParentChildOrganizations;
use App\Role;
use App\RoleUser;
use App\State;
use App\User;
use App\Rule as Ruls;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\withErrors;
use Illuminate\Validation\Rule;
use Session;
use Validator;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $user = Auth::user();
        return view('users.index', compact('user'));
    }

    public function show($id)
    {
        $roles = $this->getRoles();
        $authOrganizationId = Auth::user()->organization_id;

        $organizationsIds = ParentChildOrganizations::active()->where('parent_org_id', $authOrganizationId)->pluck('child_org_id')->toArray();

        array_push($organizationsIds, $authOrganizationId);
        // dd($authOrganizationId);

        $organizationStatusArray = [];

        foreach ($organizationsIds as $key => $value) {

            $organizationName = Organization::findOrFail($value)->org_name;
            if ( $value == $authOrganizationId ) {
                $organizationStatusArray['parent_' . $value] = $organizationName;
            } else {
                $organizationStatusArray['child_' . $value] = $organizationName;
            }

        }
        
        return view('users.show', compact('roles', 'organizationStatusArray'));

    }

    public function indexUsers()
    {
        $organizationId = Auth::user()->organization_id;
        $admin = Auth::user();
        $arr = ParentChildOrganizations::active()->where('parent_org_id', $organizationId)->pluck('child_org_id')->toArray();
        array_push($arr, $organizationId);
        $rootUserId = RoleUser::where('role_id', Constant::ROOT_USER)->pluck('user_id');
        if ($organizationId == Constant::CHARITYQ_ID)
        {
            $users = User::active()->whereIn('organization_id', $arr)->whereNotIn('id', [$admin->id, $rootUserId])->get();

        }
        else {
            $users = User::active()->whereIn('organization_id', $arr)->where('id', '<>', $admin->id)->get();
        }
        return view('users.indexUsers', compact('users', 'admin'));
    }

    public function create(Request $request)
    {
        $organization = new Organization;
        $organization->org_name = $request->org_name;
        $organization->organization_type_id = $request->organization_type_id;
        $organization->street_address1 = $request->street_address1;
        $organization->street_address2 = $request->street_address2;
        $organization->city = $request->city;
        $organization->state = $request->state;
        $organization->zipcode = $request->zipcode;
        $organization->phone_number = $request->phone_number;
        $organization->save();
        $orgId = $organization->id;

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->email;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->street_address1 = $request->street_address1;
        $user->street_address2 = $request->street_address2;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zipcode = $request->zipcode;
        $user->phone_number = $request->phone_number;
        $user->organization_id = $orgId;
        // save default rule to accept all
        $rl = new Ruls;
        $rl->rule_type_id = 1;
        $rl->rule_owner_id = $orgId;
        $rl->orgtype = "[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\"]";
        $rl->dntype = "[\"1\",\"2\",\"3\",\"4\",\"5\"]";
        $rl->taxex = false;
        $rl->save();

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|regex:/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',
            'zipcode' => 'required|numeric|digits:5',
            'state' => 'required',
            'password' => 'required|confirmed|min:6|max:15',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->save();
        $user->roles()->attach(Constant::BUSINESS_ADMIN);
        //RoleUser::create(['role_id' => $request->role_id, 'user_id' => $user->id]);
        $userid = $user->id;

        //fire NewBusiness event to initiate sending welcome mail

        event(new NewBusiness($user));

        //fire AddDefaultTemplates event to update database with default email templates

        event(new AddDefaultTemplates($organization->id));

        if (env('securityquestion') == 'true') {
            return redirect('/securityquestions/create')->with('userId', $userid);
        } else {
            $credentials = array(
                'email' => $request->email,
                'password' => $request->password
            );

            if (Auth::attempt($credentials)) {
                return redirect('subscription');
            } else {
                return redirect('subscription');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $user_details = User::findOrFail(Auth::user()->id);
        $organization = Organization::findOrFail($user_details->organization_id);

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->email;
        $user->email = $request->email;
        $string = str_random(10);
        $user->password = bcrypt($string);
        $user->street_address1 = $organization->street_address1;
        $user->street_address2 = $organization->street_address2;
        $user->city = $organization->city;
        $user->state = $organization->state;
        $user->zipcode = $organization->zipcode;
        $user->organization_id = explode("_", $request->location)[1];
        $user->phone_number = $organization->phone_number;

        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->save();

        $user->roles()->attach($request->role_id);

        //fire NewBusiness event to initiate sending welcome mail

        event(new NewSubBusiness($user));


        return redirect('user/manageusers');
    }

    public function edit()
    {
        redirect('user/editprofile');
    }

    public function editProfile($messages = '')
    {
        $states = State::pluck('state_name', 'state_code');
        $user = Auth::user();

        return view('users.edit', compact('user', 'states'))->with('messages', $messages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        if ($request->userId == $id)
        {
            $validator = Validator::make($request->all(), [
                'phone_number' => 'required|regex:/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/',
                'zipcode' => 'required|numeric|digits:5',
                'state' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($id),
                ],

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $userUpdate = $request->all();
            User::find($id)->update([
                'first_name' => $userUpdate['first_name'],
                'last_name' => $userUpdate['last_name'],
                'email' => $userUpdate['email'],
                'user_name' => $userUpdate['email'],
                'street_address1' => $userUpdate['street_address1'],
                'street_address2' => $userUpdate['street_address2'],
                'city' => $userUpdate['city'],
                'state' => $userUpdate['state'],
                'zipcode' => $userUpdate['zipcode'],
                'phone_number' => $userUpdate['phone_number']
            ]);
            $messages = 'Profile updated successfully';
            // return view('users.index', compact('user'));
            Return redirect('user/editprofile')->with('messages', $messages);
        }
        return redirect('/home')->withErrors(array('0' => 'You do not have access to edit this user!!'));
    }

    public function editSubUser($id)
    {
        $id = decrypt($id);
        $roles = $this->getRoles();

        $user = User::findOrFail($id);

        $authOrganizationId = Auth::user()->organization_id;

        $organizationsIds = ParentChildOrganizations::active()->where('parent_org_id', $authOrganizationId)->pluck('child_org_id')->toArray();
        array_push($organizationsIds, $authOrganizationId);

//        $orgNames = Organization::whereIn('id', $organizationsIds)->pluck('org_name', 'id');

        $states = State::pluck('state_name', 'state_code');

        $organizationStatusArray = [];

        foreach ($organizationsIds as $key => $value) {

            $organizationName = Organization::findOrFail($value)->org_name;
            if ( $value == $authOrganizationId ) {
                $organizationStatusArray['parent_' . $value] = $organizationName;
            } else {
                $organizationStatusArray['child_' . $value] = $organizationName;
            }

        }
        $currentOrg = User::where('id', $id)->value('organization_id');
        if (ParentChildOrganizations::where('parent_org_id', $currentOrg)->count() > 0){
            $currentOrg = 'parent_' . $currentOrg;
        } else {
            $currentOrg = 'child_' . $currentOrg;
        }
        //dd($currentOrg);
        return view('users.editsubuser', compact('user', 'organizationStatusArray', 'roles', 'currentOrg'))->with('states', $states);
    }

    public function updateSubUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $orgId = explode("_", $request->organization_id)[1];

        $userName = $request->email;

        $request->merge(['organization_id' => $orgId]);
        $request->merge(['user_name' => $userName]);
        $userUpdate = $request->all();
        // Find user and only update role if they are not a root user
        if ((count(RoleUser::where('user_id', $userUpdate['id'])->where('role_id', Constant::ROOT_USER)->pluck('id'))== 0) AND User::findorFail($request->id)->update([
                'id' => $userUpdate['id'],
                'first_name' => $userUpdate['first_name'],
                'last_name' => $userUpdate['last_name'],
                'email' => $userUpdate['email'],
                'user_name' => $userUpdate['email'],
                'organization_id' => $userUpdate['organization_id'],
                'role_id' => $userUpdate['role_id']
            ])) {
            RoleUser::where('user_id', $request->id)->first()->update($userUpdate);
        }

        $organizationId = Auth::user()->organization_id;
        $admin = Auth::user();
        $arr = ParentChildOrganizations::active()->where('parent_org_id', $organizationId)->pluck('child_org_id')->toArray();
        array_push($arr, $organizationId);
        $users = User::active()->whereIn('organization_id', $arr)->where('id', '<>', $admin->id)->get();

        return view('users.indexUsers', compact('users', 'admin'));
    }

//    public function destroy($id)
//    {
//        User::find($id)->update(['active' => Constant::INACTIVE]);
//        return redirect('users.indexUsers');
//    }

    public function destroy($id, $active)
    {
        //
        $user = User::findOrFail($id);
        if ($active == 1) {
            $active = 0;
        }else {
            $active = 1;
        }
        \DB::table('users')->where('id', 'LIKE', $user->id)->update(['active' => $active]);
        Return redirect('user/manageusers');
    }

    public function deactivate ($id) {
        $user = Auth::user();
        \DB::table('users')->where('id', 'LIKE', $user->id)->update(['active' => 0]);
        Auth::logout();
    }

    protected function getRoles()
    {
        $authUser = Auth::user();
        // Check for root
        if ($authUser->hasRole(Constant::ROOT_USER)) {
            return Role::where('id', '<>', Constant::ROOT_USER)->pluck('name', 'id');
        } 
        // if not root it must be CQ Admin or User
        if ($authUser->hasRole(Constant::TAGG_ADMIN)) {
            return Role::whereIn('id', [Constant::TAGG_ADMIN, Constant::TAGG_USER])->pluck('name', 'id');
        }
        // If not both they must be business admins or users
            return Role::whereIn('id', [Constant::BUSINESS_ADMIN, Constant::BUSINESS_USER])->pluck('name', 'id');
    }
}