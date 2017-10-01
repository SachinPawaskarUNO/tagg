<?php
namespace App\Http\Controllers;

use App\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\withErrors;
use Illuminate\Support\Facades\Validator;


class DonationRequestController extends Controller
{
    public function index()
    {
        $donationrequests = DonationRequest::paginate(5);
        return view('donationrequests.index', compact('donationrequests'));
    }

    public function create()
    {
        return view('donationrequests.create');
    }

    public function edit($id)
    {
        $donationrequest=DonationRequest::find($id);
        return view('donationrequests.edit',compact('donationrequest'));
    }

    public function update($id,Request $request)
    {

        $donationrequest= new DonationRequest($request->all());
        $donationrequest=DonationRequest::find($id);
        $donationrequest->update($request->all());
        return redirect('donationrequests');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return redirect
     */


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requester' => 'required',
            'requester_type' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address1' => 'required',
            // 'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'taxexempt' => 'required',
            'item_requested' => 'required',
            'item_purpose' => 'required',
            'eventname' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'eventpurpose' => 'required',
            'formAttendees' => 'required',
            'venue' => 'required',
            'marketingopportunities' => 'required'
        ]);
        //dd($request);
        if ($validator->fails())
        {
            return redirect('donationrequests') ->withErrors($validator)->withInput();
        }
        $donationRequest = new DonationRequest;
        $donationRequest->organization_id = $request->orgId;
        $donationRequest->requester = $request->requester;
        $donationRequest->requester_type = $request->requester_type;
        $donationRequest->first_name = $request->firstname;
        $donationRequest->last_name = $request->lastname;
        $donationRequest->email = $request->email;
        $donationRequest->phone_number = $request->phonenumber;
        $donationRequest->street_address1 = $request->address1;
        $donationRequest->street_address2 = $request->address2;
        $donationRequest->city = $request->city;
        $donationRequest->state = $request->state;
        $donationRequest->zipcode = $request->zipcode;
        $donationRequest->tax_exempt = $request->taxexempt;
        $donationRequest->item_requested = $request->item_requested;
        $donationRequest->item_purpose = $request->item_purpose;
        $donationRequest->event_name = $request->eventname;
        $donationRequest->event_start_date = $request->startdate;
        $donationRequest->event_end_date = $request->enddate;
        $donationRequest->event_purpose = $request->eventpurpose;
        $donationRequest->est_attendee_count = $request->formAttendees;
        $donationRequest->venue = $request->venue;
        $donationRequest->marketing_opportunities = $request->marketingopportunities;
        $donationRequest->save();

        return redirect('/');
    }

    public function show($id)
    {
        $donationrequest = DonationRequest::findOrFail($id);
        return view('donationrequests.show',compact('donationrequest'));
    }

    public function searchDonationRequest(Request $request) {

        $query = $request->q;
        $donationrequests = DonationRequest::where('requester', 'LIKE', "%$query%")->paginate(3);
        return view('donationrequests.index', compact('donationrequests'));
    }
}