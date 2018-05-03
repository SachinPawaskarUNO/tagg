<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUserId = \Auth::user()->id;
        $user = \App\User::find($loggedInUserId);
        $userRole = $user->roles[0]->name;
//        $status = \DB::table('users')->select('active')->where('users.id', '=', $user)->get();
//        $active = $status[0]->active;
//
//        if ($active == 0) {
//            Auth::logout();
//            return view('errors.invalid');
//        }

        return view('home', ['role' => $userRole]);
    }


}