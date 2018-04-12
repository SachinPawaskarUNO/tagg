<?php

namespace App\Http\Controllers;
use App\Custom\Constant;
use App\DonationRequest;
use App\EmailTemplate;
use App\ParentChildOrganizations;
use App\RoleUser;
use Auth;
use Illuminate\Http\Request;
use App\Mail\SendManualRequest;

class EmailTemplateController extends Controller
{
    private $defaultemail;

    public function __construct()
    {
        // This will be used when sending default approve or reject emails
        $this->defaultemail = new EmailController();
    }

    public function index()
    {
        // displays all email templates available for the business user.
        $email_templates = [];
        $org_id = Auth::user()->organization_id;
        $user_id = Auth::id();
        $user_role = RoleUser::where('user_id', $user_id)->value('role_id'); //get user role of current user

        if ($user_role == Constant::ROOT_USER OR $user_role == Constant::TAGG_ADMIN OR $user_role == Constant::BUSINESS_ADMIN) {
            //find approval and rejection emails templates 
            $approval_email_templates = EmailTemplate::wherein('template_type_id', [Constant::REQUEST_APPROVED, Constant::REQUEST_APPROVED_DEFAULT])->where('organization_id', $org_id)->get();
            $rejection_email_templates = EmailTemplate::wherein('template_type_id', [Constant::REQUEST_REJECTED, Constant::REQUEST_REJECTED_DEFAULT])->where('organization_id', $org_id)->get();

        }

        return view('emailtemplates.index', compact('approval_email_templates', 'rejection_email_templates'));
    }

    public function update(Request $request, $id)
    {
        // update existing email templates
        
        $email_template = EmailTemplate::findOrFail($id);
        $email_template->update($request->all());
        $email_template->email_desc = $request->email_desc;
        $email_template->save();

        return redirect('emailtemplates');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $email_template = EmailTemplate::findOrFail($id);
        return view('emailtemplates.edit', compact('email_template'));
    }


    /**
     * Uses Template model to send values like email template to populate in email editor,
     * email ids and donation request ids of selected requests
     *
     * @param Request $request gets hiddenname which is an array of ids selected in dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function send(Request $request)
    { 
        $ids_string = $request->ids_string;
        if (!empty($ids_string)) {
            $page_from = $request->page_from;
            $org_id = Auth::user()->organization_id;

            // Storing what button is clicked
            // either accept or reject
            $change_status = $request->submitbutton;
            
            $ids_array = [];
            $ids_array = explode(',', $ids_string); //split string into array seperated by ', '

            //get email ids
            $emails = DonationRequest::whereIn('id', $ids_array)->pluck('email');
            $emails = str_replace(array("[", "]", '"'), "", ($emails));

            //get first and last names in string
            $firstNames = DonationRequest::whereIn('id', $ids_array)->pluck('first_name');
            $lastNames = DonationRequest::whereIn('id', $ids_array)->pluck('last_name');
            
            //if current organization is a child location get parent's email template
            $organizationId = ParentChildOrganizations::where('child_org_id', $org_id)->value('parent_org_id');
            if ($organizationId){
                $org_id = $organizationId;
            }
            
            $email_templates = [];           
            $user_id = Auth::id();
            $user_role = RoleUser::where('user_id', $user_id)->value('role_id'); //get user role of current user
            
            //returns to different views based on button clicked by user 'Approve' or 'Reject'
            if ($change_status == 'Approve & customize response' || $change_status == 'Approve & send default email') { // enters in this loop for any approval type 
                if ($user_role == Constant::ROOT_USER OR $user_role == Constant::TAGG_ADMIN OR $user_role == Constant::BUSINESS_ADMIN) 
                {
                    if($change_status == 'Approve & send default email') 
                    {   // Approve default case - Send default email
                        $email_templates = EmailTemplate::where('template_type_id', Constant::REQUEST_APPROVED_DEFAULT)->where('organization_id', $org_id)->first();
                        dd($email_templates);
                        $e = $this->defaultemail->email($email_templates,$ids_array ,$firstNames,$lastNames,$change_status);
                        return redirect($page_from)->with('message', $e);
                    } else 
                    {   // Approve case - proceed to choose from approval templates
                        $email_templates = EmailTemplate::wherein('template_type_id', [Constant::REQUEST_APPROVED, Constant::REQUEST_APPROVED_DEFAULT])->where('organization_id', $org_id)->get();
                    }   
                }
                return view('emailtemplates.emailtype', compact('email_templates', 'emails', 'firstNames', 'lastNames', 'ids_string', 'page_from'));
            } else {
                //get email template for Reject id value = 4
                if ($user_role == Constant::ROOT_USER OR $user_role == Constant::TAGG_ADMIN OR $user_role == Constant::BUSINESS_ADMIN) 
                {
                    if($change_status == 'Reject & send default email') 
                    {   // Reject default case - Send default rejection email
                        $email_templates = EmailTemplate::where('template_type_id', Constant::REQUEST_REJECTED_DEFAULT)->where('organization_id', $org_id)->first();
                        $e = $this->defaultemail->email($email_templates,$ids_array ,$firstNames,$lastNames,$change_status);
                        return redirect($page_from)->with('message', $e);
                    } else 
                    { 
                        // Approve case - proceed to choose from rejection templates
                        $email_templates = EmailTemplate::wherein('template_type_id', [Constant::REQUEST_REJECTED,Constant::REQUEST_REJECTED_DEFAULT])->where('organization_id', $org_id)->get();
                    }                   
                }
                return view('emailtemplates.emailtype', compact('email_templates', 'emails', 'firstNames', 'lastNames', 'ids_string', 'page_from'));
            }
        } else {
            //do not redirect to email editor if no request is selected
            return redirect('/dashboard')->with('message', 'Please select one or multiple donation request(s).');
        }
    }

    public function sendemail(Request $request)
    {
        // handles selected approval or rejection email request and redirect to email editor 
        $page_from = $request->page_from;           // redirected to this page
        $ids_string = $request->ids_string;         // email ids  
        $org_id = Auth::user()->organization_id;    // current user's org id
        $emails = $request->emails;                 // donation requestor's email addresses
        $firstNames = $request->firstNames;         // donation requestor's first names
        $lastNames = $request->lastNames;           // donation requestor's last names

        //if current organization is a child location get parent's email template
        $organizationId = ParentChildOrganizations::where('child_org_id', $org_id)->value('parent_org_id');
            if ($organizationId){
                $org_id = $organizationId;
            }
        //find selected email template 
        
        $email_template = EmailTemplate::findOrFail($request->emailid);

        if ($email_template->template_type_id == Constant::REQUEST_APPROVED || $email_template->template_type_id == Constant::REQUEST_APPROVED_DEFAULT) { // for approval email
                return view('emaileditor.approvesendmail', compact('email_template', 'emails', 'firstNames', 'lastNames', 'ids_string', 'page_from'));
           } elseif ($email_template->template_type_id ==  Constant::REQUEST_REJECTED || $email_template->template_type_id ==  Constant::REQUEST_REJECTED_DEFAULT) { // for rejection email
               return view('emaileditor.rejectsendmail', compact('email_template', 'emails', 'firstNames', 'lastNames', 'ids_string', 'page_from'));       
        }
    }
}