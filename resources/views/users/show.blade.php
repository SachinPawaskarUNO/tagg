@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"> <h1 style="text-align: left;font-weight: bold;">Create A User</h1></div>
                    <div class="panel-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{ Form::hidden('organization_id', Auth::user()->organization_id) }}
                        {!! Form::open(['url' => 'users']) !!}
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('First Name', 'First Name')!!}
                            <span style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                            {!! Form::text('first_name',null,['class'=>'form-control', 'id' => 'first_name','placeholder'=>'Enter First Name', 'required'])!!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Last Name', 'Last Name') !!}
                            <span style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                            {!! Form::text('last_name',null,['class'=>'form-control', 'id' => 'last_name','placeholder'=>'Enter Last Name','required']) !!}
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address</label>
                            <span style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                            <input id="email" type="email" class="form-control" name="email"
                                   placeholder="Enter Email Address"
                                   value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            {!! Form::label('Business Location', 'Business Location') !!}
                            <span style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                            {!! Form::select('location', array_merge(['' => '-- Please Select --'], $organizationStatusArray), null, ['class' => 'form-control', 'id' => 'loc-drop-down', 'required']) !!}
                        </div>

                        <div id="role-toggle">
                            <div class="form-group" id="role-group" style="display:none">
                                {!! Form::label('Role', 'Role') !!}
                                <span style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                {!! Form::select('role_id', $roles, null, ['class' => 'form-control', 'id' => 'locations-drop-down-parent']) !!}
                            </div>
                        </div>

                    </div>


                    <div class="form-group">
                        <div class=" col-md-offset-5">
                            <button class="btn savebtn" type="submit" class="" id="createbutton">Submit</button>
                            <input class="btn backbtn" type="button" value="Cancel" onClick="history.go(-1);">
                            <span style="color: red"> <h5> Fields Marked With (*) Are Mandatory </h5></span>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#loc-drop-down").change(function () {

            if (this.value == '') {
                // Not showing Roles dropdown and its label when nothing is
                // selected in locations dropdown
                document.getElementById("role-group").style.display = "none";
            } else {
                // Showing Roles dropdown and its label when a value is
                // selected in locations dropdown
                document.getElementById("role-group").style.display = "block";
                if (this.value.startsWith('parent')) {
                    document.getElementById("locations-drop-down-parent").style.display = "block";
                    document.getElementById("locations-drop-down-child").style.display = "none";
                    document.getElementById("locations-drop-down-child").setAttribute('name', 'dummy-name');
                    document.getElementById("locations-drop-down-parent").setAttribute('name', 'role_id');
                } else if (this.value.startsWith('child')) {
                    document.getElementById("locations-drop-down-child").style.display = "block";
                    document.getElementById("locations-drop-down-parent").style.display = "none";
                    document.getElementById("locations-drop-down-parent").setAttribute('name', 'dummy-name');
                    document.getElementById("locations-drop-down-child").setAttribute('name', 'role_id');

                }
            }

        });
    </script>
@stop
