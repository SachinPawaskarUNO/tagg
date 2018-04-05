@extends('layouts.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('js/stripe.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default" style="padding-left: 5px;padding-right: 5px;">
                    <div class="panel-heading"><h1> Add Payment Information</h1></div>
                    <h2 style="text-align:center;"></h2>

                {{ Form::open(['method'=> 'POST', 'action' => 'SubscriptionController@getIndex','id'=>'subscription-form']) }}

                {{ csrf_field() }}
                <fieldset>

                    @if(session('response'))
                        <div class="col-md-8 alert alert-success">
                            {{@session('response')}}
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group{{ $errors->has('user_locations') ? ' has-error' : '' }}">
                                <div class="panel panel-default">
                                    <div class="panel-heading">

                                        <div class="panel-heading"><h1 style="text-align: center;"> Choose Your Plan</h1>
                                        </div>
                                    </div>
                                </div>
                                <label class="control-label" for="user_locations">Locations</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="user_locations" id="user_locations" required>
                                        <option value="5">Up to 5</option>
                                        <option value="25">Up to 25</option>
                                        <option value="100">Up to 100</option>
                                        <option value="101+">Unlimited</option>
                                    </select>

                                    @if ($errors->has('user_locations'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_locations') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label for="plan" class="control-label">Plan</label>
                                <div class="col-lg-6">

                                    <select class="form-control" name="plan" id="plan" required>
                                        <option value="">Select...</option>
                                        <option value="Monthly">Monthly</option>
                                        <option value="Annually">Annually</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6" style="padding-bottom: 12px;">
                            </div>
                            <div class="col-sm-12">
                                <label for="coupon" class="control-label">Promo Code</label>
                                <div class="col-md-6" style="padding-left: 0px;">
                                    <input id="coupon" type="text" class="form-control" name="coupon"
                                           value="{{ old('coupon') }}" placeholder="Promo Code"
                                           autofocus>
                                    <div style="padding-bottom: 15px;"></div>
                                    <input type="button"
                                           class="btn btn-basic pull-right" style="padding-left:1%;" id="apply"
                                           value='Apply'
                                           disabled/>

                                    @if ($errors->has('coupon'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-sm-12" style="max-height: 15px;font-size: 14px;" id="coupon-message"></div>
                        </div>
                        <div class="col-xs-12 col-md-4 hide" id="cart">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-heading">
                                        <h1 style="text-align: center;">Cart Details</h1>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <table class="table table-striped table-hover table-bordered" id="cart_table">
                                        <tbody>
                                        <tr>
                                            <th>Locations</th>
                                            <th>Plan</th>
                                            <th>Total Price</th>
                                        </tr>
                                        <tr>
                                            <td id="location_selected"></td>
                                            <td id="plan_selected"></td>
                                            <td id="total_price"></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2"><span class="pull-right">Discount</span></th>
                                            <th id="discounted_price">0</th>
                                        </tr>
                                        <tr>
                                            <th colspan="2"><span class="pull-right">Balance</span></th>
                                            <th id="balance_price"></th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <div class="panel-heading"><h1 style="text-align: center;"> Payment Details </h1>
                                    </div>


                                </div>
                                <div class="panel-body">
                                    <div class="stripe-errors panel" style="color:red;"></div>
                                    <form role="form">
                                        <div class="form-group">
                                            <label for="cardNumber">
                                                CARD NUMBER</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="cardNumber" maxlength="16"
                                                       data-stripe="number"
                                                       placeholder="Valid Card Number"
                                                       required autofocus/>
                                                <span class="input-group-addon"><span
                                                            class="glyphicon glyphicon-lock"></span></span>

                                            </div>
                                            <span id="card_error" style="color: red; display: none;"></span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7 col-md-7 pull-left">
                                                <label for="expityMonth">EXPIRY DATE</label>
                                                <div class="form-group">

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
                                                <span id="expiry_error" style="color: red; display: none;"></span>
                                            </div>
                                            <div class="col-xs-5 col-md-5 pull-right">
                                                <div class="form-group">
                                                    <label for="cvCode">
                                                        CVV</label>
                                                    <input type="password" class="form-control" data-stripe="cvc"
                                                           maxlength="3" size="3"
                                                           id="cvCode"
                                                           placeholder="CVV" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <button class="btn btn-success btn-lg btn-block" type="submit" id="buttonPay">Pay</button>
                        </div>
                    </div>

                </fieldset>

            </div>
                @if(Session::has('message'))
                    <div class="alert alert-warning">{{ Session::get('message') }}</div>
                @endif
            {{form::token()}}
            {{ Form::close() }}
        </div>

    </div>
    </div>
    </body>



@endsection
{{--@section('scripts')--}}

{{--@endsection--}}

