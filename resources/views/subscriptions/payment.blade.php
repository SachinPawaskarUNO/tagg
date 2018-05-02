@extends('layouts.app')

@section('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('js/stripe.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center" style="font-size:26px;">Subscription</h1>
    
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
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
                @if(Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                <div class="panel panel-default">
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
                                    {{--<label class="control-label" for="user_locations">Locations</label>--}}

                                    <div class="col-md-12 choose-plan-block">
                                        <fieldset class="form-group" name = "user_locations" id="user_locations" required>
                                            <label class="control-label large-font" for="user_locations">Locations</label><br/>
                                            <input type="radio" value="5" name="user_locations" checked><label >&nbsp; Up to 5</label><br />
                                            <input type="radio" value="25" name="user_locations"><label >&nbsp; Up to 25</label><br />
                                            <input type="radio" value="100" name="user_locations"><label >&nbsp; Up to 100</label><br />
                                            <input type="radio" value="101+" name="user_locations"><label >&nbsp; unlimited</label><br />

                                        </fieldset>

                                        @if ($errors->has('user_locations'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('user_locations') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div style="padding-top: 12px;">
                                    <div class="col-md-6 choose-plan-block" >
                                        <fieldset class="form-group" name="plan" id="plan" required>
                                            <label class="control-label large-font" for="plan">Plan <span
                                                        style="color: red; font-size: 20px; vertical-align:middle;">*</span></label><br/>
                                            <input id = "plan" type="radio" name="plan" value="Monthly" ><label>&nbsp; Monthly</label><br />
                                            <input id = "plan" type="radio" name="plan" value="Annually"><label>&nbsp; Annually</label><br />
                                        </fieldset>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-bottom: 12px;">
                                </div>
                                <div class="col-md-12">
                                    <span class="choose-plan-error">Please choose a plan.</span>
                                </div>
                                <div class="col-md-12">
                                    <label for="coupon" class="control-label normal-font">PROMO CODE</label>
                                    <div class="col-md-6" style="padding-left: 0px;">
                                        <input id="coupon" type="text" class="form-control" name="coupon"
                                               value="{{ old('coupon') }}" placeholder="Promo Code"
                                               autofocus>
                                        <div style="padding-bottom: 15px;"></div>
                                        <input style="text-align:center" type="button"
                                               class="btn savebtn pull-right" style="padding-left:1%;" id="apply"
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
                            <div class="col-xs-12 col-md-4 hide" id="cart" style="display:none">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="panel-heading">
                                            <h1 style="text-align: center;">Cart Details</h1>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <table class="table table-striped table-hover table-bordered large-font" id="cart_table">
                                            <tbody>
                                            <tr>
                                                <th>Locations</th>
                                                <th>Plan</th>
                                                <th>Total Price</th>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center;" id="location_selected"></td>
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
                                    <div class="panel-body card-info-block">
                                        <div class="stripe-errors panel" style="color:red;"></div>
                                        <form role="form">
                                            <div class="form-group">
                                                <label id = cardNumberLabel class="large-font" for="cardNumber">
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
                                                    <label for="expityMonth" class="large-font">EXPIRY DATE</label>
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
                                                        <label for="cvCode" class="large-font">
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

                                <button class="btn btn-success btn-lg btn-block" type="button" id="buttonPay">Pay</button>
                            </div>
                        </div>

                    </fieldset>
                     <div class="alert" id="coupon-message"></div>
                
                </div>
                {{form::token()}}
                {{ Form::close() }}
            </div>

        </div>
    </div>
@endsection
{{--@section('scripts')--}}

{{--@endsection--}}









