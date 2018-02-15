<?php

namespace App\Http\Controllers;

use App\Custom\Constant;
use App\DonationRequest;
use App\Mail\SendManualRequest;
use Auth;
use Illuminate\Http\Request;
use Mail;


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
     * Gets email ids, edited email template and sends email by calling SendManualRequest Mailable
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function manualRequestMail(Request $request) {

        //get donation request ids by converting string to array
        $ids_array = explode(',', $request->ids_string); //split string into array separated by ', '

        //get email ids
        $emails = DonationRequest::whereIn('id', $ids_array)->pluck('email');
        $firstNames = str_replace(array("[", "]", '"'), '', $request->firstNames);
        $firstNames = explode(',', $firstNames);
        $lastNames = str_replace(array("[", "]", '"'), '', $request->lastNames);
        $lastNames = explode(',', $lastNames);

        // Storing the existing template that was populated in the editor
        $default_template = $request->email_message;
        foreach($emails as $index => $email) {
            // $request->email_message = str_replace('{Addressee}', $firstNames[$index] . ' ' . $lastNames[$index], $request->email_message);
            $request->email_message = str_replace('{Addressee}', $firstNames[$index], $request->email_message);
            $request->email_message = str_replace('{My Business Name}', Auth::user()->organization->org_name, $request->email_message);

            $donation_id = $ids_array[$index];
            $donation = DonationRequest::where('id', $donation_id)->get();
            $userName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $userId = Auth::id();
            $organizationId = Auth::user()->organization_id;

            if($request->status == 'Approve'){
                //update donation request status in database
                $donation[0]->update([
                    'approval_status_id' => Constant::APPROVED,
                    'approval_status_reason' => 'Approved by '.$userName,
                    'approved_organization_id' => $organizationId,
                    'approved_user_id' => $userId,
                    'email_sent' => true
                ]);
            } elseif($request->status == 'Reject'){
                $donation[0]->update([
                    'approved_dollar_amount' => 0.00,
                    'approval_status_id' => Constant::REJECTED,
                    'approval_status_reason' => 'Rejected by '.$userName,
                    'approved_organization_id' => $organizationId,
                    'approved_user_id' => $userId,
                    'email_sent' => true
                ]);
            }

            Mail::to($email)->send(new SendManualRequest($request));
            $request->email_message = $default_template;
        }

        $redirect_to = $request->page_from;
        return redirect($redirect_to);
    }
}