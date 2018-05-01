@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"><h1 style="text-align: left;font-size:22px;">Update Profile</h1></div>

                    <div class="panel-body">

                        {!! Form::model($user, ['method' => 'POST', 'route'=>['updatesubuser'], 'class' => 'form-horizontal']) !!}

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
                        <div class="">
                            {!! Form::hidden('id',$user->id,['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label id = 'first_name'for="first_name" class="col-md-4 control-label"> First Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::text('first_name',null,['class' => 'form-control', 'id' => 'first_name', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label id = 'last_name' for="last_name" class="col-md-4 control-label"> Last Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::text('last_name', null,['class' => 'form-control', 'id' => 'last_name', 'required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label id = 'email'for="email" class="col-md-4 control-label">E-Mail Address <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">{!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email','required']) !!}</div>
                        </div>

                        <div class="form-group">
                            <label id = 'organization' for="organization_id" class="col-md-4 control-label">Business Location <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                {!! Form::select('organization_id', $organizationStatusArray, $currentOrg, ['class' => 'form-control', 'id' => 'organization', 'id' => 'loc-drop-down', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group" id="role-group" style="display:block">
                            <label id = 'role' for="Role" class="col-md-4 control-label"> Role: <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-6">
                                @if(App\ParentChildOrganizations::active()->where('parent_org_id', $user->organization->id)->count() > 0)
                                    {!! Form::select('role_id', $roles, $user->roles->first()->id, ['class' => 'form-control', 'id' => 'locations-drop-down-parent', 'style' => 'display:block']) !!}
                                    {{--  {!! Form::select('role_id', array('5' => $roles[5]), $user->roles->first()->id, ['class' => 'form-control', 'id' => 'locations-drop-down-child', 'style' => 'display:none']) !!}  --}}
                                @else
                                    {!! Form::select('role_id', $roles, $user->roles->first()->id, ['class' => 'form-control', 'id' => 'locations-drop-down-parent']) !!}
                                    {{--  {!! Form::select('role_id', array('5' => $roles[5]), $user->roles->first()->id, ['class' => 'form-control', 'id' => 'locations-drop-down-child', 'style' => 'display:none']) !!}  --}}
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                {!! Form::submit('Update', ['class' => 'btn btn-basic']) !!}
                                <input class="btn backbtn" type="button" value="Cancel" onClick=location.href='{{ url('/dashboard')}}'>
                                <span style="color: red"> <h5>Fields Marked With (<span style="color: red; font-size: 20px; vertical-align:middle;">*</span>) Are Mandatory</h5></span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#loc-drop-down").change(function () {
            if (this.value.startsWith('parent')) {
                // Displaying locations drop-down for parent and hiding children's
                document.getElementById("locations-drop-down-parent").style.display = "block";
                document.getElementById("locations-drop-down-child").style.display = "none";
                // replacing name to a temporary name called dummy-name
                // in order to not submitted into database
                document.getElementById("locations-drop-down-child").setAttribute('name', 'dummy-name');
                document.getElementById("locations-drop-down-parent").setAttribute('name', 'role_id');
            } else if (this.value.startsWith('child')) {
                // Displaying locations drop-down for children and hiding parents
                document.getElementById("locations-drop-down-child").style.display = "block";
                document.getElementById("locations-drop-down-parent").style.display = "none";
                // replacing name to a temporary name called dummy-name
                // in order to not submitted into database
                document.getElementById("locations-drop-down-parent").setAttribute('name', 'dummy-name');
                document.getElementById("locations-drop-down-child").setAttribute('name', 'role_id');
            }

        });

        $(document).ready(function() {

            if ($('#loc-drop-down').find(":selected").val().startsWith('parent')) {
                // Displaying locations drop-down for parent and hiding children's
                document.getElementById("locations-drop-down-parent").style.display = "block";
                document.getElementById("locations-drop-down-child").style.display = "none";
                // replacing name to a temporary name called dummy-name
                // in order to not submitted into database
                document.getElementById("locations-drop-down-child").setAttribute('name', 'dummy-name');
                document.getElementById("locations-drop-down-parent").setAttribute('name', 'role_id');
            } else {
                // Displaying locations drop-down for children and hiding parents
                document.getElementById("locations-drop-down-child").style.display = "block";
                document.getElementById("locations-drop-down-parent").style.display = "none";
                // replacing name to a temporary name called dummy-name
                // in order to not submitted into database
                document.getElementById("locations-drop-down-parent").setAttribute('name', 'dummy-name');
                document.getElementById("locations-drop-down-child").setAttribute('name', 'role_id');
            }
        });

    </script>

@endsection
