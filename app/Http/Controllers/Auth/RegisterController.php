<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Organization_type;
use App\State;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */


//    protected $redirectTo = '/home';

    protected $redirectTo = '/securityquestions/create';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Overwritten function from RegistersUsers class
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $states = State::pluck('state_name', 'state_code');
        $Organization_types = Organization_type::pluck('type_name', 'id');
        return view('auth.register', compact('states', 'Organization_types'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|confirmed|string|min:6|max:15',
            'password-confirm' => 'required|string|min:6|max:15|same:password',
            'street_address1' => 'required|string|max:100',
            'street_address2' => 'nullable|string|max:100',
            'city' => 'required|string|max:25',
            'state' => 'required|string|max:30',
            'zipcode' => 'required|numeric|max:5',
            'phone_number' => 'required|numeric|max:10',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'user_name' => $data['email'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'street_address1' => $data['street_address1'],
            'street_address2' => $data['street_address1'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zipcode' => $data['zipcode'],
            'phone_number' => $data['phone_number']
        ]);

        //fire NewBusiness event to initiate sending welcome mail

        //event(new NewBusiness($user));

        return $user;
    }
}
