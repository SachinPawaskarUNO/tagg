@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register Your Business</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="{{ action('UserController@create') }}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script>
$(window).load(function()
{
   var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-##############"}];
    $('#phone_number').inputmask({ 
        mask: phones, 
        greedy: false, 
        definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
}); 



</script>  
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label"> First Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required title="Your First Name should be 2-20 characters long." class="form-control" name="first_name"
                                           value="{{ old('first_name') }}" placeholder="Your First Name" required
                                           autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label"> Last Name <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required title="Your Last Name should be 2-20 characters long." class="form-control" name="last_name"
                                           value="{{ old('last_name') }}" placeholder="Your Last Name" required
                                           autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  class="form-control" name="email"
                                           value="{{ old('email') }}" placeholder="Enter Your Email Address" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Create Password <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                           placeholder="Enter Password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Enter Password Again" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }}">
                                <label for="org_name" class="col-md-4 control-label"> Name Of Your Business <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="org_name" type="text" class="form-control" name="org_name"
                                           value="{{ old('org_name') }}" placeholder="Name of The Organization" required
                                           autofocus>

                                    @if ($errors->has('org_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('org_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('organization_type_id') ? ' has-error' : '' }}">
                                <label for="org_description" class="col-md-4 control-label"> Business Type <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    {!! Form::select('organization_type_id', array(null => 'Select...') + $Organization_types->all(), null, ['class'=>'form-control']) !!}
                                    @if ($errors->has('organization_type_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('organization_type_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('street_address1') ? ' has-error' : '' }}">
                                <label for="street_address1" class="col-md-4 control-label">Address 1 <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="street_address1" type="text" class="form-control" name="street_address1"
                                           value="{{ old('street_address1') }}"
                                           placeholder="Street Address, Company Name, C/O" required autofocus>

                                    @if ($errors->has('street_address1'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('street_address1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="street_address2" class="col-md-4 control-label"> Address 2 </label>

                                <div class="col-md-6">
                                    <input id="street_address2" type="text" class="form-control" name="street_address2"
                                           value="{{ old('street_address2') }}"
                                           placeholder="Building, Apartment, Floor">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city" class="col-md-4 control-label">City <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city"
                                           value="{{ old('city') }}" placeholder="Name of the City" required autofocus>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state" class="col-md-4 control-label">State <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    {!! Form::select('state', array(null => 'Select...') + $states->all(), null, ['class'=>'form-control']) !!}
                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-4 control-label">Zip Code <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="zipcode" type="text" pattern="[0-9]{5}" required title="Enter a 5 digit zipcode" class="form-control"
                                           name="zipcode" value="{{ old('zipcode') }}" placeholder="ZipCode" required
                                           autofocus>

                                    @if ($errors->has('zipcode'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="col-md-4 control-label">Phone Number <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                                <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control"
                                           name="phone_number" value="{{ old('phone_number') }}" required
                                           autofocus>
                                   

 
                                    @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                    <span style="color: red"> <h5>Fields Marked With (<span
                                                    style="color: red; font-size: 20px; vertical-align:middle;">*</span>) Are Mandatory</h5></span>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
