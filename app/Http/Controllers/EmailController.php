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

    /**
     * Gets email ids, edited email template and sends email by calling SendManualRequest Mailable
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function manualRequestMail(Request $request) {

        //get donation request ids by converting string to array
        $idsArray = explode(',', $request->idsString); //split string into array separated by ', '

        //get email ids
        $emails = DonationRequest::whereIn('id', $idsArray)->pluck('email');
        $names = str_replace(array('":"')," ", $request-> names);
        $names =str_replace(array("{", "}", '"'),"", $names);
        $names = explode(',', $names);

        // Storing the existing template that was populated in the editor
        $initialTemplate = $request->email_message;

        foreach($emails as $index => $email)
        {
            $request->email_message = str_replace('{patron}', $names[$index], $request->email_message);
            $request->email_message = str_replace('{organization}', Auth::user()->organization->org_name, $request->email_message);

            $donation_id = $idsArray[$index];
            $donation = DonationRequest::where('id', $donation_id)->get();

            if($request->status == 'Approve'){
                //update donation request status in database
                $donation[0]->update(['approval_status_id' => 5]);
            }
            elseif($request->status == 'Reject'){
                $donation[0]->update(['approval_status_id' => 4]);
            }
            $donation[0]->update(['approved_organization_id' => Auth::user()->organization_id]);
            $donation[0]->update(['approved_user_id' => Auth::user()->id]);

            Mail::to($email)->send(new SendManualRequest($request));
            $request->email_message = $initialTemplate;
        }

        $redirectto = $request->pagefrom;
        return redirect($redirectto);
    }
}