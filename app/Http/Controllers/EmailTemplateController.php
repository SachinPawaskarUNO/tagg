<?php

namespace App\Http\Controllers;

use App\Custom\Constant;
use App\DonationRequest;
use App\EmailTemplate;
use App\ParentChildOrganizations;
use App\RoleUser;
use Auth;
use Illuminate\Http\Request;


class EmailTemplateController extends Controller
{

    public function index()
    {

        $email_templates = [];
        $org_id = Auth::user()->organization_id;
        $user_id = Auth::id();
        $user_role = RoleUser::where('user_id', $user_id)->value('role_id'); //get user role of current user

        if ($user_role == Constant::ROOT_USER OR $user_role == Constant::TAGG_ADMIN OR $user_role == Constant::BUSINESS_ADMIN) {

            $email_templates = EmailTemplate::where('organization_id', $org_id)->get();


        }

        return view('emailtemplates.index', compact('email_templates'));
    }

    public function update(Request $request, $id)
    {
        $email_template = EmailTemplate::findOrFail($id);
        $email_template->update($request->all());
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

            //returns to different views based on button clicked by user 'Approve' or 'Reject'
            if ($change_status == 'Approve') {

                //get email template for Approve id value = 3
                // $email_template = EmailTemplate::where('template_type_id', Constant::REQUEST_APPROVED)->where('organization_id', $org_id)->get();
                $email_template = EmailTemplate::where([
                    ['template_type_id', Constant::REQUEST_APPROVED],
                ])->get();
                $email_template = $email_template[0]; //convert collection into an array
                
                return view('emaileditor.approvesendmail', compact('email_template', 'emails', 'firstNames', 'lastNames', 'ids_string', 'page_from'));
            } else {

                //get email template for Reject id value = 4
                // $email_template = EmailTemplate::where('template_type_id', Constant::REQUEST_REJECTED)->where('organization_id', $org_id)->get();
                $email_template = EmailTemplate::where([
                    ['template_type_id', Constant::REQUEST_REJECTED],
                ])->get();
                $email_template = $email_template[0]; //convert collection into an array
                return view('emaileditor.rejectsendmail', compact('email_template', 'emails', 'firstNames', 'lastNames', 'ids_string', 'page_from'));
            }
        } else {
            //do not redirect to email editor if no request is selected
            return redirect('/dashboard')->with('message', 'select something');
        }
    }
}

