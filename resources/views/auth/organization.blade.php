@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:22px;"> Business Details</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="post"
                              action="{{ action('OrganizationController@create') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('org_name') ? ' has-error' : '' }}">
                                <label for="org_name" class="col-md-4 control-label"> Name of Your Business <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="org_name" type="text" class="form-control" name="org_name"
                                           value="{{ old('org_name') }}" placeholder="Name of Your Business" required
                                           autofocus>

                                    @if ($errors->has('org_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('org_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('org_description') ? ' has-error' : '' }}">
                                <label for="org_description" class="col-md-4 control-label"> Business Type <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="org_description" type="text" class="form-control" name="org_description"
                                           value="{{ old('org_description') }}"
                                           placeholder="Description of Your Business Ex.Restraunt, Gas Station"
                                           required autofocus>

                                    @if ($errors->has('org_description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('org_description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('street_address1') ? ' has-error' : '' }}">
                                <label for="street_address1" class="col-md-4 control-label">Address 1 <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="street_address1" type="text" class="form-control" name="street_address1"
                                           value="{{ old('street_address1') }}"
                                           placeholder="Street Address, Company Name" required autofocus>

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
                                <label for="city" class="col-md-4 control-label">City <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

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
                                <label for="state" class="col-md-4 control-label">State <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">

                                    <select class="form-control" name="state" id="state" required autofocus>
                                        <option value="Select State">Select State</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>

                                    @if ($errors->has('state'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('zipcode') ? ' has-error' : '' }}">
                                <label for="zipcode" class="col-md-4 control-label">Zip Code <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="zipcode" type="text" pattern="[0-9]{5}" class="form-control"
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
                                <label for="phone_number" class="col-md-4 control-label">Phone Number <span
                                            style="color: red; font-size: 20px; vertical-align:middle;">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number"
                                           value="{{ old('phone_number') }}" placeholder="Example ###-###-####"required
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
                                    <button type="submit" class="btn btn-basic">
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