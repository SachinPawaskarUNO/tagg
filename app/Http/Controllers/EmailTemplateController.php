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

    public function send(Request $request)
    {
        $string = $request->hiddenname;
        $changestatus = $request->submitbutton;
        $idsArray = [];
        $array = explode(',', $string); //split string into array seperated by ', '
        foreach($array as $value) //loop over values
        {
            array_push($idsArray, $value);
        }

        $emails = DonationRequest::whereIn('id', $idsArray)->pluck('email');
        $names = DonationRequest::whereIn('id', $idsArray)->pluck('first_name').DonationRequest::whereIn('id', $idsArray)->pluck('last_name');

        if ($changestatus == 'Approve') {
            $emailtemplate = EmailTemplate::findOrFail(8);
            return view('emaileditor.approvesendmail', compact('emailtemplate', 'emails', 'names', 'idsArray'));
        }
        else {
            $emailtemplate = EmailTemplate::findOrFail(9);
            return view('emaileditor.rejectsendmail', compact('emailtemplate', 'emails', 'names', 'idsArray'));
        }

        //return view('emaileditor.editsendmail', compact('emailtemplate', 'emails'));
    }
}

