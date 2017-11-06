<?php

namespace App\Http\Controllers;
use App\DonationRequest;
use Illuminate\Http\Request;
use App\Mail\SendManualRequest;
use Mail;
use Auth;


class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
 /*   public function email(){

        Mail::send(

            ['text'=>'emails.startmail'],[],function($message){
            $message->to(Auth::user()->email,Auth::user()->first_name)->subject('Welcome to CommUnityQ');
            $message->from('tagg@gmail.com','tagg');
        });
        Mail::to(Auth::user()->email)->send(new RegistrationSuccessful(Auth::user()));

        return redirect('\home');

    }*/

    public function manualRequestMail(Request $request) {

        $emails = str_replace(array("[","]",'"'),"", ($request-> To));
        $array = explode(',', $emails); //split string into array seperated by ', '
        $emails=[];
        foreach($array as $value) //loop over values
        {
            array_push($emails, $value);
        }
        $names = str_replace(array('","')," ", ($request-> names));
        $names = str_replace(array('"]["'),",", ($names));
        $names =str_replace(array("[","]",'"'),"", ($names));
        $array = explode(',', $names);
        $names=[];
        foreach($array as $value) //loop over values
        {
            array_push($names, $value);
        }
        //dd($names);
        foreach($emails as $index => $email)
        {
            $request->email_message = str_replace('{patron}',$names[$index], $request->email_message);
            $request->email_message = str_replace('{organization}',Auth::user()->organization->org_name, $request->email_message);
            if($request->status == 'Approve'){

            }
            elseif($request->status == 'Reject'){

            }
            Mail::to($email)->send(new SendManualRequest($request));
        }


        return back();
    }
}