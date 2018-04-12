
@extends('layouts.app')
@section('content')
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript"
            src="https://unpkg.com/iframe-resizer@3.5.15/js/iframeResizer.contentWindow.min.js"></script>

    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
        webshims.setOptions('forms-ext', {types: 'date'});
        webshims.polyfill('forms forms-ext');
    </script>

    <script>
        $(document).ready(function () {
            var phones = [{"mask": "(###) ###-####"}];
            $('#phone_number').inputmask({
                mask: phones,
                greedy: false,
                definitions: {'#': {validator: "[0-9]", cardinality: 1}}
            });
            if ("{!! ! empty($_GET['newrequest']) !!}" != "") {
                $('#app').hide();
                $('#navDemo').wrap('<span style="display: none;" hidden />');
            }

        });


    </script>
    <script src="{{asset('js/jquery.number.min.js')}}"></script>
    {{ csrf_field() }}

    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center" style="font-size:26px;">Donation Request</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    <div class="container donationrequest">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="divRequestForm" class="panel panel-default">
                    <div class="panel-heading"><h1 style="font-size:22px;">Please complete the following information to submit your donation request</h1></div>

                    <div class="panel-body">
                    {!! Form::open(['url' => 'attachment', 'class' => 'form-horizontal', 'id' => 'donationRequestForm', 'files' => true]) !!}
                    {{ csrf_field() }}


                    <!-- <form class="form-horizontal" method="POST" action="{{ action('DonationRequestController@store') }}">
                            {{ csrf_field() }} -->
                        <input type="hidden" name="orgId" value="{{ $_GET['orgId'] }}">
                        <div class="form-group{{ $errors->has('requester') ? ' has-error' : '' }}">
                            <label for="requester" class="col-md-4 control-label ">Name of the Organization <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-md-6">

                                <input id="requester" type="text" class="form-control" name="requester"
                                       value="{{ old('requester')}}" placeholder="Name of Your Organization" required
                                       autofocus>


                                @if ($errors->has('requester'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('requester') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('requester_type') ? ' has-error' : '' }}">
                            <label for="requester_type" class="col-md-4 control-label">Requester Organization Type <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                {!! Form::select('requester_type', array(null => 'Select...') + $requester_types->all(), null, ['class'=>'form-control', 'id' => 'Org_type', 'required']) !!}
                                @if ($errors->has('requester_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('requester_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" pattern="^[a-zA-Z][a-z  A-Z0-9-_\s]{1,20}$" required
                                       title="Your First Name should be 2-20 characters long." class="form-control"
                                       name="firstname" value="{{ old('firstname') }}"
                                       placeholder="Enter Your First Name" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" pattern="^[a-zA-Z][a-z A-Z0-9-_\s]{1,20}$" required
                                       title="Your Last Name should be 2-20 characters long." class="form-control"
                                       name="lastname" value="{{ old('lastname') }}" placeholder="Enter Your Last Name"
                                       required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email Address <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" placeholder="Enter Your Email Address"
                                       required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Phone Number <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-md-6">
                                <input id="phone_number" type="tel" class="form-control"
                                       name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter Your Phone Number" required >
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                            <label for="address1" class="col-md-4 control-label">Address 1 <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="address1" type="text" class="form-control" name="address1"
                                       value="{{ old('address1') }}" placeholder="Street Address/PO Box" required>

                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address2" class="col-md-4 control-label">Address 2</label>
                            <div class="col-md-6">
                                <input id="address2" type="text" class="form-control" name="address2"
                                       value="{{ old('address2') }}" placeholder="Address 2">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"
                                       placeholder="Enter Your City" required>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>

                            <div class="col-md-6">
                                {!! Form::select('state', array(null => 'Select...') + $states->all(), null, ['class'=>'form-control', 'id' => 'state', 'required']) !!}
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                            <label for="zipcode" class="col-md-4 control-label">Zip Code <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="zipcode" type="number" min ='0'
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                       maxlength="5" class="form-control" name="zipcode"
                                       value="{{ old('zipcode') }}" placeholder="Zip Code" required>

                                @if ($errors->has('zipcode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tax_exempt') ? ' has-error' : '' }}">
                            <label for="tax_exempt" class="col-md-4 control-label"> Are you a 501c3? <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>

                            <div class="col-md-6">

                                <label for="chkYes">
                                    <input type="radio" onclick="yesnoCheck();" name="tax_exempt" id="yesCheck"
                                           value="1">Yes
                                </label>
                                <label for="chkNo">
                                    <input type="radio" onclick="yesnoCheck();" name="tax_exempt" id="noCheck"
                                           value="0">No
                                </label>
                                @if ($errors->has('tax_exempt'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tax_exempt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}" id="file_upload">
                            <label for="attachment" class="col-md-4 control-label">Attachment <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <small>Supported File Types: doc, docx, pdf, jpeg, png, jpg, svg</small>
                            <div class="col-md-4">
                                <input type="file" class="form-control" name="attachment" id="attachment">
                                @if ($errors->has('attachment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('attachment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('item_requested') ? ' has-error' : '' }}">
                            <label for="item_requested" class="col-md-4 control-label">Request For <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>

                            <div class="col-md-6">
                                {!! Form::select('item_requested', array('' => '-- Please Select --') + $request_item_types->all(), null, ['id' => 'item_requested','class'=>'form-control', 'required']) !!}
                                @if ($errors->has('item_requested'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item_requested') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" id="explain">
                            <div class="col-md-4">

                            </div>

                            <div class="col-md-6">
                                <textarea name="item_requested_explain" id="item_requested_explain" class="form-control"
                                          pattern="[a-zA-Z0-9\s]"
                                          maxlength="1000"
                                          title="Please restrict your Text Length to 100 characters"
                                          rows="3"
                                          placeholder="Explain the Requested item within 100 characters"></textarea>
                                <!--<input id="item_requested_explain" type="textbox" name="other" style="visibility:hidden;" required autofocus/>-->
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dollar_amount') ? ' has-error' : '' }}">
                            <label for="dollar_amount" class="col-md-4 control-label">Dollar Amount<span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-md-6">
                                <input id="dollar_amount" type="text" min="0" step="1" 
                                       required
                                       title="Please use the format $ for this field. " class="form-control"
                                       name="dollar_amount" value="{{ old('dollar_amount') }}"
                                       onblur="setTwoNumberDecimal(this)"
                                       placeholder="0" 
                                       maxlength="7">

                                @if ($errors->has('dollar_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dollar_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('item_purpose') ? ' has-error' : '' }}">
                            <label for="item_purpose" class="col-md-4 control-label">Donation Purpose <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span> </label>
                            <div class="col-md-6">
                                {!! Form::select('item_purpose', array('' => '-- Please Select --') + $request_item_purpose->all(), null, ['id' => 'item_purpose','class'=>'form-control', 'required']) !!}
                                @if ($errors->has('item_purpose'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item_purpose') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="explain_purpose">
                            <div class="col-md-4">

                            </div>

                            <div class="col-md-6">
                                <textarea name="item_purpose_explain" id="item_purpose_explain" class="form-control"
                                          pattern="[a-zA-Z0-9\s]"
                                          maxlength="200"
                                          title="Please restrict your Text Length to 100 characters"
                                          rows="3"
                                          placeholder="Explain your donation Purpose within 200 characters"
                                ></textarea>

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_date') ? ' has-error' : '' }}">
                            <label for="needed_by_date" class="col-md-4 control-label">Needed by Date <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="needed_by_date" type="date" class="form-control" name="needed_by_date"
                                       value="{{ old('needed_by_date') }}" placeholder="The Request Needed Date"
                                       required>

                                @if ($errors->has('needed_by_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('needed_by_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('eventname') ? ' has-error' : '' }}">
                            <label for="eventname" class="col-md-4 control-label">Name of the Event <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="eventname" type="text" class="form-control" name="eventname"
                                       value="{{ old('eventname') }}" placeholder="Enter Name of Your Event" required>

                                @if ($errors->has('eventname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('eventname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('event_date') ? ' has-error' : '' }}">
                            <label for="event_date" class="col-md-4 control-label">Event Date <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">
                                <input id="event_date" type="date" class="form-control" name="event_date"
                                       value="{{ old('event_date') }}" placeholder="Start Date" required>

                                @if ($errors->has('event_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('event_type') ? ' has-error' : '' }}">
                            <label for="event_type" class="col-md-4 control-label">Purpose of The Event <span
                                        style="color: red; font-size: 20px; vertical-align:middle;"></span></label>
                            <div class="col-md-6">
                                {!! Form::select('event_type', array(null => 'Select...') + $request_event_type->all(), null, ['class'=>'form-control', 'id' => 'event_type']) !!}
                                @if ($errors->has('event_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('formAttendees') ? ' has-error' : '' }}">
                            <label for="formAttendees" class="col-md-4 control-label">Estimated Number of Attendees<span
                                        style="color: red; font-size: 20px; vertical-align:middle;"></span> </label>
                            <div class="col-md-6">
                                <input id="formAttendees" type="number" step="1" min="0" class="form-control"
                                       name="formAttendees"
                                       value="{{ old('formAttendees') }}" placeholder="Approx. Number of Attendees" >

                                @if ($errors->has('formAttendees'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('formAttendees') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('inputvenue') ? ' has-error' : '' }}">
                            <label for="inputvenue" class="col-md-4 control-label">Event Venue or Address<span
                                        style="color: red; font-size: 20px; vertical-align:middle;"></span> </label>

                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control" name="venue"
                                       value="{{ old('venue') }}" placeholder="Place event will be held">

                                @if ($errors->has('venue'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('venue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('marketingopportunities') ? ' has-error' : '' }}">
                            <label for="marketingopportunities" class="col-md-4 control-label">What are the marketing
                                opportunities? <span style="color: red; font-size: 20px; vertical-align:middle;"></span>
                            </label>

                            <div class="col-md-6">
                                <textarea
                                        placeholder="Explain how you will let others know my business has contributed to your cause"
                                        class="form-control" input id="marketingopportunities" pattern="[a-zA-Z0-9\s]"
                                        maxlength="1000" title="Please restrict your Text Length to 1000 characters"
                                        name="marketingopportunities" rows="5"
                                        value="{{ old('marketingopportunities') }}"></textarea>

                                @if ($errors->has('marketingopportunities'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marketingopportunities') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="button" id="btnSubmit" class="btn btn-basic">
                                    Send Request
                                </button>

                                <input id="hiddenSubmit" type="submit" class="btn btn-basic" style="display: none">
                            <div><span style="color: red"> <h5>Fields Marked With (<span
                                style="color: red; font-size: 20px; align:middle;">*</span>) Are Mandatory</h5></span>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <span data-iframe-height/>
                </div>
            </div>
        </div>
    </div>
    <script>
        @if (! $errors->any())
        $('#file_upload').hide();
        $('#explain').hide();
        $('#explain_purpose').hide();
        @endif

        $('#attachment').removeProp('required');

        function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
                $('#file_upload').show();
                $('#attachment').prop('required');
            }
            else {
                $('#file_upload').hide();
                $('#attachment').removeProp('required');
            }
        }
        $('#item_requested').change(function () {
            if ($(this).val() == 5) {
                $('#explain').show();
            } else {
                $('#explain').hide();
                $('#item_requested_explain').val('');
            }
        });
        $('#item_purpose').change(function () {
            if ($(this).val() == 9) {
                $('#explain_purpose').show();
            } else {
                $('#explain_purpose').hide();
                $('#item_purpose_explain').val('');
            }
        });

        function setTwoNumberDecimal(e) {
                if(e.value == 0) {
                e.value =0;
            }
        }

        $('#btnSubmit').on('click', function () {
            if (document.getElementById('yesCheck').checked) {
                if ($('#attachment')[0].files.length === 0) {
                    alert("Attachment Required");
                    $(this).focus();
                }
                else {
                    //alert("Checked: true, Attachment: true");
                    $('#hiddenSubmit').click();
                }
            }
            else {
                //alert("Checked: false");
                $('#hiddenSubmit').click();
            }
        });
    
        $("#zipcode").on('keypress', function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            return false;
        }
        
    });

    </script>
@endsection
