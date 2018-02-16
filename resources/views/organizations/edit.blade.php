@extends('layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Business Profile</h1>

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
                                style="text-align: left;font-weight: bold;">Update Location</h1></div>

                    <div class="panel-body">

                        {!! Form::model($organization, ['method' => 'PATCH','route'=>['organizations.update', $organization->id], 'class' => 'form-horizontal']) !!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
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

                                {!! Form::select('state', array(null => 'Select...') + $states->all(), old('state'), ['class'=>'form-control']) !!}

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
                                {!! Form::submit('Save', ['class' => 'btn savebtn', 'id' => 'btnSave']) !!}
                                <button id="btnEdit" class="btn savebtn hidden" type="button">Edit</button>
                                <input class="btn backbtn" type="button" value="Cancel" onClick="history.go(-1);">
                                <span style="color: red"> <h5>Fields Marked With (<span
                                                style="color: red; font-size: 20px; align:middle;">*</span>) Are Mandatory</h5></span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->organization_id == $organization->id)
<script>
    @if (! $errors->any())
    $(window).load(function() {
        $("input").attr("readonly", true);
        $("select").attr("disabled", true);
        $("#btnSave").addClass("hidden");
        $("#btnCancel").addClass("hidden");
        $('#btnEdit').removeClass('hidden');
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
