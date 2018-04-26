<?php

namespace App\Http\Controllers;

use App\Custom\Constant;
use App\DonationRequest;
use App\Organization;
use App\EmailTemplate;
use Carbon\Carbon;
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
        $organizationId = Auth::user()->organization_id;
        // Storing the existing template that was populated in the editor
        $default_template = $request->email_message;
        $change_status = $request->status; // approve or reject 
        $budgetfail = false; // used later when budget limit is crossed 
        $rjctemail = EmailTemplate::where('template_type_id', Constant::REQUEST_REJECTED_DEFAULT)->where('organization_id',  $organizationId)->first();
        foreach($emails as $index => $email) {
            // $request->email_message = str_replace('{Addressee}', $firstNames[$index] . ' ' . $lastNames[$index], $request->email_message);
            $request->email_message = str_replace('{Addressee}', $firstNames[$index], $request->email_message);
            $request->email_message = str_replace('{My Business Name}', Auth::user()->organization->org_name, $request->email_message);

            $donation_id = $ids_array[$index];
            $donation = DonationRequest::find($donation_id);

            $userName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $userId = Auth::id();
            if ($donation->approved_dollar_amount === "0.00") { // to check if custom donation amount
                $donation->approved_dollar_amount = $donation->dollar_amount;
            }
            // get monthly budget 
            $monthlyBudget = Organization::where('id', $organizationId)->pluck('monthly_budget')->first(); 
            if($request->status == 'Approve & customize response'){
                 // calculate remaining budget for current month  
                 $totaldonatedamt = DonationRequest::where('approval_status_id', Constant::APPROVED)
                 ->where('approved_organization_id', $organizationId)
                 ->whereMonth('created_at', Carbon::now()->month) 
                 ->sum('approved_dollar_amount');
                 
                if ($monthlyBudget !== "0.00"){
                    // check for remaining amount 
                    $remainingBudget = $monthlyBudget - $totaldonatedamt;
                    
                    //update donation request status in database
                    if ($donation->dollar_amount <= $remainingBudget) 
                    {
                        //update donation request status in database
                        $e = "Email sent successfully";
                        $donation->update([
                            'approved_dollar_amount' => $donation->approved_dollar_amount,
                            'approval_status_id' => Constant::APPROVED,
                            'approval_status_reason' => 'Approved by '.$userName,
                            'approved_organization_id' => $organizationId,
                            'approved_user_id' => $userId,
                            'email_sent' => true
                        ]);
                    } else { 
                        // requested amount is greater than remaining budget
                        $budgetfail = true;
                        $e = 'Monthly budget limit of $'.$monthlyBudget . ' ' . 'has been reached.';
                        $request->email_message = $rjctemail->email_message;
                        $request->email_message = str_replace('{Addressee}', $firstNames[$index], $request->email_message);
                        $request->email_message = str_replace('{My Business Name}', Auth::user()->organization->org_name, $request->email_message);                                  
                        $donation->update([
                            'approved_dollar_amount' => 0.00,
                            'approval_status_id' => Constant::REJECTED,
                            'approval_status_reason' => 'Would Exceed Monthly Budget',
                            'approved_organization_id' => $organizationId,
                            'approved_user_id' => $userId,
                            'email_sent' => true
                        ]);
                       
                    }
                } else {
                        // if monthly budget is not set all requests will be approved. 
                        //update donation request status in database
                        $e = "Email sent successfully";
                        $donation->update([
                            'approved_dollar_amount' => $donation->approved_dollar_amount,
                            'approval_status_id' => Constant::APPROVED,
                            'approval_status_reason' => 'Approved by '.$userName,
                            'approved_organization_id' => $organizationId,
                            'approved_user_id' => $userId,
                            'email_sent' => true
                        ]);
                    }         

            } elseif($request->status == 'Reject & customize response'){
                $e = "Email sent successfully";
                $donation->update([
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

        if($budgetfail === false ){$e = "Email sent successfully";} 
        else { $e = 'Monthly budget limit of $'.$monthlyBudget . ' ' . 'has been reached.';}
        
        $redirect_to = $request->page_from;
        return redirect($redirect_to)->with('message', $e);
    }
    public function email($email_templates,$ids_array,$firstNames,$lastNames,$change_status) {
        // This is called by EmailTemplateController to send default approval and rejection emails.
        // Get email ids
        $emails = DonationRequest::whereIn('id', $ids_array)->pluck('email');
              
        // Storing the existing template that was populated in the editor
        $default_template = $email_templates->email_message;
        $organizationId = Auth::user()->organization_id;

        $budgetfail = false; // used later when budget limit is crossed 
        $rjctemail = EmailTemplate::where('template_type_id', Constant::REQUEST_REJECTED_DEFAULT)->where('organization_id',  $organizationId)->first();

        foreach($emails as $index => $email) {          
            $email_templates->email_message = str_replace("{Addressee}", $firstNames[$index], $email_templates->email_message);
            $email_templates->email_message = str_replace("{My Business Name}", Auth::user()->organization->org_name, $email_templates->email_message);
            
            $donation_id = $ids_array[$index];
            $donation = DonationRequest::find($donation_id);
            $userName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $userId = Auth::id();
            // dd($donation->approved_dollar_amount);
            if ($donation->approved_dollar_amount === "0.00") { // to check if custom donation amount
                $donation->approved_dollar_amount = $donation->dollar_amount;
            }
            // get monthly budget 
            $monthlyBudget = Organization::where('id', $organizationId)->pluck('monthly_budget')->first();

            if($change_status == 'Approve & send default email'){
                // calculate remaining budget for current month  
                $totaldonatedamt = DonationRequest::where('approval_status_id', Constant::APPROVED)
                                                    ->where('approved_organization_id', $organizationId)
                                                    ->whereMonth('created_at', Carbon::now()->month) 
                                                    ->sum('approved_dollar_amount');
                                                    
                if ($monthlyBudget !== "0.00"){
                    // check for remaining amount 
                    $remainingBudget = $monthlyBudget - $totaldonatedamt;
                    
                    //update donation request status in database
                    if ($donation->dollar_amount <= $remainingBudget) 
                    {
                        //update donation request status in database

                        $e = "Email sent successfully";
                        $donation->update([
                            'approved_dollar_amount' => $donation->approved_dollar_amount,
                            'approval_status_id' => Constant::APPROVED,
                            'approval_status_reason' => 'Approved by '.$userName,
                            'approved_organization_id' => $organizationId,
                            'approved_user_id' => $userId,
                            'email_sent' => true
                        ]);
                    } else { 
                        // requested amount is greater than remaining budget
                        $budgetfail = true;
                        $e = 'Monthly budget limit of $'.$monthlyBudget . ' ' . 'has been reached.';
                        $request->email_message = $rjctemail->email_message;
                        $request->email_message = str_replace('{Addressee}', $firstNames[$index], $request->email_message);
                        $request->email_message = str_replace('{My Business Name}', Auth::user()->organization->org_name, $request->email_message);                                  
                        $donation->update([
                            'approved_dollar_amount' => 0.00,
                            'approval_status_id' => Constant::REJECTED,
                            'approval_status_reason' => 'Would Exceed Monthly Budget',
                            'approved_organization_id' => $organizationId,
                            'approved_user_id' => $userId,
                            'email_sent' => true
                        ]);
                        return $e;
                    }
                } else {
                // if monthly budget is not set all requests will be approved. 
                //update donation request status in database
                $e = "Email sent successfully";
                $donation->update([
                    'approved_dollar_amount' => $donation->approved_dollar_amount,
                    'approval_status_id' => Constant::APPROVED,
                    'approval_status_reason' => 'Approved by '.$userName,
                    'approved_organization_id' => $organizationId,
                    'approved_user_id' => $userId,
                    'email_sent' => true
                ]);
                }

            } elseif($change_status == 'Reject & send default email'){
                $e = "Email sent successfully";
                $donation->update([
                    'approved_dollar_amount' => 0.00,
                    'approval_status_id' => Constant::REJECTED,
                    'approval_status_reason' => 'Rejected by '.$userName,
                    'approved_organization_id' => $organizationId,
                    'approved_user_id' => $userId,
                    'email_sent' => true
                ]);
            }
            Mail::to($email)->send(new SendManualRequest($email_templates));
            $email_templates->email_message = $default_template;
        }
        if($budgetfail === false ){$e = "Email sent successfully";} 
        else { $e = 'Monthly budget limit of $'.$monthlyBudget . ' ' . 'has been reached.';}
        return $e;
    }
}