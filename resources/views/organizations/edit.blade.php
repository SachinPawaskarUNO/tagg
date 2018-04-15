@extends('layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:26px;">Business Profile</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script>
        $(window).load(function () {
            var phones = [{"mask": "(###) ###-####"}];
            $('#phone_number').inputmask({
                mask: phones,
                greedy: false,
                definitions: {'#': {validator: "[0-9]", cardinality: 1}},

            });

        });

    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1
                                style="text-align: left;">Update Location</h1></div>

                    <div class="panel-body">

                        {!! Form::model($organization, ['method' => 'PATCH','route'=>['organizations.update', $organization->id], 'class' => 'form-horizontal', 'id' => 'update-form']) !!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ Session::get('success') }}
                                </ul>
                            </div>
                        @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="org_name" class="col-md-4 control-label"> Business Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                <input id="org_name" type="text" class="form-control" name="org_name"
                                       value="{{ old('org_name', $organization->org_name) }}" required >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('org_description') ? ' has-error' : '' }}">
                            <label for="org_description" class="col-md-4 control-label">Business Description</label>

                            <div class="col-md-6">
                                <input id="org_description" type="text" class="form-control" name="org_description"
                                       value="{{ old('org_description', $organization->org_description) }}">

                                @if ($errors->has('org_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('org_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                        {{--<label for="org_description" class="col-md-4 control-label">Business Type <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>--}}

                        {{--<div class="col-md-6">--}}

                        {{--{!! Form::select('organization_type_id', array(null => 'Select...') + $Organization_types->all(), null, ['class'=>'form-control','required', 'disabled']) !!}--}}

                        {{--@if ($errors->has('organization_type_id'))--}}
                        {{--<span class="help-block">--}}
                        {{--<strong>{{ $errors->first('organization_type_id') }}</strong>--}}
                        {{--</span>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="street_address1" class="col-md-4 control-label"> Address 1 <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                <input id="street_address1" type="text" class="form-control" name="street_address1" required
                                       value="{{ old('street_address1', $organization->street_address1) }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="street_address2" class="col-md-4 control-label"> Address 2 </label>
                            <div class="col-lg-6">
                                <input id="street_address2" type="text" class="form-control" name="street_address2"
                                       value="{{ old('street_address2', $organization->street_address2) }}"  >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="city" class="col-md-4 control-label">City <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                <input id="city" type="text" class="form-control" name="city"
                                       value="{{ old('city', $organization->city) }}" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="state" class="col-md-4 control-label">State <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">

                                {!! Form::select('state', array(null => 'Select...') + $states->all(), old('state'), ['class'=>'form-control', 'id' => 'state']) !!}

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                            <label for="zip_code" class="col-md-4 control-label">Zip Code <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                <input id="zip_code" type="text" class="form-control" name="zip_code"
                                       value="{{ old('zip_code', $organization->zipcode) }}" maxlength="5" required >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : ''}}">
                            <label for="phone_number" class="col-md-4 control-label">Phone Number <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="{{ old('phone_number', $organization->phone_number) }}" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                {!! Form::submit('Save', ['class' => 'btn btn-basic', 'id' => 'btnSave']) !!}
                                <button id="btnEdit" class="btn btn-basic hidden" type="button">Edit</button>
                                <input id = 'Cancel' class="btn backbtn" type="button" value="Cancel" onClick=location.href='{{ url('/dashboard')}}'>
                                <span style="color: red"> <h5>Fields Marked With (<span
                                                style="color: red; font-size: 20px; align:middle;">*</span>) Are Mandatory</h5></span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @if((Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN) && $parent == true )
                        {!! Form::model($organization, ['method' => 'PATCH','route'=>['organizations.update', $organization->id], 'class' => 'form-horizontal', 'id' => 'new-card-form']) !!}
                        <div class="stripe-errors panel" style="color:red;"></div>
                        <div class="form-group">
                            <label for="cardNumber" class="col-md-4 control-label">
                                CARD NUMBER</label>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="cardNumber" maxlength="16"
                                           data-stripe="number"
                                           placeholder="**** **** **** {{ $organization->card_last_four }}"
                                           required autofocus/>
                                    <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-lock"></span></span>
                                </div>
                            </div>
                            <span id="card_error" style="color: red; display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label for="expityMonth" class="col-md-4 control-label">EXPIRY DATE</label>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-xs-6" style="padding-right: 5px;">
                                        <input type="text" class="form-control" data-stripe="exp-month"
                                               id="expiryMonth" placeholder="MM" maxlength="2" size="2"
                                               required/>
                                    </div>
                                    <div class="col-xs-6" style="padding-left:5px;">
                                        <input type="text" class="form-control" data-stripe="exp-year"
                                               id="expiryYear" placeholder="YY" maxlength="2" size="2"
                                               required/>
                                    </div>
                                </div>
                            </div>
                            <span id="expiry_error" style="color: red; display: none;"></span>
                        </div>
                        <div class="form-group">
                            <label for="cvCode" class="col-md-4 control-label">
                                CVV</label>
                            <div class="col-lg-6">
                                <input type="password" class="form-control" data-stripe="cvc"
                                       maxlength="3" size="3"
                                       id="cvCode"
                                       placeholder="CVV" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="button" class="btn btn-basic" id="update-default-card">Update card details</button>
                                {{--{!! Form::submit('Update card details', ['class' => 'btn btn-basic', 'id' => 'buttonPay']) !!}--}}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @endif
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->organization_id == $organization->id)
            <script src="https://js.stripe.com/v2/"></script>
            <script src="{{asset('js/stripe.js')}}"></script>
            <script>
                @if (! $errors->any())
                $(window).load(function() {
                    $("#update-form input").attr("readonly", true);
                    $("#update-form select").attr("disabled", true);
                    $("#update-form #btnSave").addClass("hidden");
                    $("#update-form #btnCancel").addClass("hidden");
                    $('#update-form #btnEdit').removeClass('hidden');
                });
                @endif
                $('#btnEdit').on('click', function () {
                    $('input').removeAttr('readonly');
                    $('select').removeAttr('disabled');
                    $('#btnSave').removeClass('hidden');
                    $('#btnEdit').addClass('hidden');
                });
                $("#zip_code").on('keypress', function (e) {
                    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                        //display error message
                        return false;
                    }
                });
            </script>
        @endif
    </div>
@endsection


