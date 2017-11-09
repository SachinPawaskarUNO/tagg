<?php

namespace App\Http\Controllers;

use App\DonationRequest;
use Illuminate\Http\Request;


use App\EmailTemplate;



use App\Http\Controllers\Controller;

class EmailTemplateController extends Controller
{
    public function index()
    {
    	
    	$emailtemplates = EmailTemplate::all();
    	return view('emailtemplates.index', compact('emailtemplates'));
    }

    public function update(Request $request, $id)
    {

        $emailtemplate = EmailTemplate::find($id);
        $emailtemplate -> update($request->all());
        $emailtemplate->save();
        return redirect('emailtemplates');
    }

    public function edit($id)
    {
        $emailtemplate = EmailTemplate::findOrFail($id);
        return view('emailtemplates.edit', compact('emailtemplate'));
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
        $idsString = $request->hiddenname;
        $pagefrom = $request->pagefrom;

        // Storing what button is clicked
        // either accept or reject
        $changestatus = $request->submitbutton;

        $idsArray = [];
        $idsArray = explode(',', $idsString); //split string into array seperated by ', '

        //get email ids
        $emails = DonationRequest::whereIn('id', $idsArray)->pluck('email');
        $emails = str_replace(array("[","]",'"'),"", ($emails));

        //get first and last names in string
        $names = DonationRequest::whereIn('id', $idsArray)->pluck('last_name', 'first_name');

        //returns to different views based on button clicked by user 'Approve' or 'Reject'
        if ($changestatus == 'Approve') {

            //get email template for Approve id value = 8
            $emailtemplate = EmailTemplate::findOrFail(8);
            return view('emaileditor.approvesendmail', compact('emailtemplate', 'emails', 'names', 'idsString', 'pagefrom'));
        }
        else {

            //get email template for Reject id value = 9
            $emailtemplate = EmailTemplate::findOrFail(9);
            return view('emaileditor.rejectsendmail', compact('emailtemplate', 'emails', 'names', 'idsString', 'pagefrom'));
        }
    }
}

