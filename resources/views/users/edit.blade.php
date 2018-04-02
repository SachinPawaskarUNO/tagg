@extends('layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">User Profile</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="container">
        <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: left;font-weight: bold;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
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

                    <div class="panel-body">
                        {{{ $messages ?? 'not set' }}}
                        {!! Form::model($user,['method' => 'PATCH','action'=>'UserController@updateProfile', 'class' => 'form-horizontal']) !!}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (strlen($messages) > 0)
                            <div class="alert alert-success">
                                <ul>
                                        <li>{{ $messages }}</li>
                                </ul>
                            </div>
                        @endif
                        {{ csrf_field() }}
                        <input name="userId" type="hidden" id="userId" value="{{ $user->id }}" />
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Role</label>
                            <div class="col-lg-6"><h5>{!! $user->roles[0]->name !!}</h5></div>
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="col-md-4 control-label"> First Name <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::text('first_name',null,['class' => 'form-control', 'id' => 'first_name', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label"> Last Name <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::text('last_name', null,['class' => 'form-control', 'id' => 'last_name', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('email',null,['class' => 'form-control', 'id' => 'email_address','required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="street_address1" class="col-md-4 control-label">Address 1 <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('street_address1',null,['class' => 'form-control', 'id' => 'Address1','required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="street_address2" class="col-md-4 control-label"> Address 2 </label>
                            <div class="col-lg-6">   {!! Form::text('street_address2', null,['class'=>'form-control', 'id' => 'Address2']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="city" class="col-md-4 control-label">City <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('city',null,['class' => 'form-control', 'id' => 'City','required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label for="state" class="col-md-4 control-label">State <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="col-md-6">

                                {!! Form::select('state', array(null => 'Select...') + $states->all(), null, ['class'=>'form-control', 'id' => 'state']) !!}

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="zipcode" class="col-md-4 control-label">Zip Code <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6"> {!! Form::text('zipcode',null,['class' => 'form-control','id'=>'zipcode','maxlength' => 5,'required']) !!}
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Phone Number <span
                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-md-6">
                                {!! Form::text('phone_number',null,['class' => 'form-control',  'id' => 'phone_number' ,'required']) !!}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                {!! Form::submit('Save', ['class' => 'btn savebtn', 'id' => 'btnSave']) !!}
                                <button id="btnEdit" class="btn savebtn" style="background-color: #0099CC;"
                                        type="button">Edit
                                </button>
                                <input id = 'cancel' class="btn backbtn" type="button" value="Cancel" onClick="history.go(-1);">
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
    <script>
        $(window).load(function() {
            $("input").attr("readonly", true);
            $("select").attr("disabled", true);
            $("#btnSave").addClass("hidden");
        });
        $('#btnEdit').on('click', function () {
            $('input').removeAttr('readonly');
            $('select').removeAttr('disabled');
            $('#btnSave').removeClass('hidden');
            $('#btnEdit').addClass('hidden');
        });
        $("#zipcode").on('keypress', function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                return false;
            }
        });

    </script>
@endsection
