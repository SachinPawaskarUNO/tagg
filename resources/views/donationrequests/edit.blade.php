@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Donation Request</div>

                    <div class="panel-body">

                        {!! Form::model($donationrequest,['method' => 'PATCH','route'=>['donationrequests.update',$donationrequest->id], 'class' => 'form-horizontal']) !!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="requester" class="col-md-4 control-label">Name Of The Organization <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::text('requester',null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="requester_type" class="col-md-4 control-label">Organization Type <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::select('requester_type', array(null => 'Select...') + $requester_types->all(), null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-md-4 control-label">First Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('first_name',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-md-4 control-label">Last Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('last_name',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email Address <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">   {!! Form::email('email', null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="phonenumber" class="col-md-4 control-label">Phone Number <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('phone_number',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="address1" class="col-md-4 control-label">Address 1 <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('street_address1',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="address2" class="col-md-4 control-label">Address 2</label>
                            <div class="col-lg-6"> {!! Form::text('street_address2',null,['class'=>'form-control']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="city" class="col-md-4 control-label">City <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('city',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="state" class="col-md-4 control-label">State <span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-lg-6">
                                {!! Form::select('state', array(null => 'Select...') + $states->all(), null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="zipcode" class="col-md-4 control-label">Zipcode <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('zipcode',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="taxexempt" class="col-md-4 control-label"> Are you a 501c3? <span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-md-6">
                                {!! Form::radio('taxexempt',null,['class' => 'form-control', 'required']) !!} Yes &nbsp;&nbsp;
                                {!! Form::radio('taxexempt',null,['class' => 'form-control', 'required']) !!} No
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="item_requested" class="col-md-4 control-label">Request For <span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-lg-6">
                                {!! Form::select('item_requested', array(null => 'Select...') + $request_item_types->all(), null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="item_purpose" class="col-md-4 control-label">Donation Purpose <span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-lg-6">
                                {!! Form::select('item_purpose', array(null => 'Select...') + $request_item_purpose->all(), null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="eventname" class="col-md-4 control-label">Name of the Event <span style="color: red; font-size: 20px; vertical-align:middle;"></span></label>
                            <div class="col-lg-6">{!! Form::text('event_name',null,['class' => 'form-control']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="startdate" class="col-md-4 control-label">Event Date <span style="color: red; font-size: 20px; vertical-align:middle;"></span></label>
                            <div class="col-lg-6">{!! Form::date('event_start_date',null,['class' => 'form-control']) !!}</div>
                        </div>


                        <div class="form-group">
                            <label for="event_type" class="col-md-4 control-label">Purpose Of The Event <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::select('item_purpose', array(null => 'Select...') + $request_item_purpose->all(), null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="formAttendees" class="col-md-4 control-label">Estimated Number Of Attendees<span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-lg-6">{!! Form::text('est_attendee_count',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="inputvenue" class="col-md-4 control-label">Event Venue or Address<span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-lg-6">{!! Form::text('venue',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="marketingopportunities" class="col-md-4 control-label">What are the marketing opportunities? <span style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-lg-6">{!! Form::text('marketing_opportunities',null,['class' => 'form-control', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ route('donationrequests.index')}}" class="btn btn-primary">Cancel</a>
                                <span style="color: red"> <h5>Fields Marked With (<span
                                                style="color: red; font-size: 20px; vertical-align:middle;">*</span>) Are Mandatory</h5></span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection