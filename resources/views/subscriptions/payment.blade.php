<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>A Tagg Intiative</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    @yield('css')


    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('header')
    <style>
        body {
            font: 16px Montserrat, sans-serif;
            font-size: small;
            line-height: 2.0;
            color: #0077aa;
            margin-bottom: 100px;
            padding: 0;
            min-height: 100%;
            position: relative;
            clear: both;
        }

        @media screen and (max-width: 600px) {
            ul.topnav li.right,
            ul.topnav li {
                float: none;
            }
        }

        h2 {
            font-size: 30px;
            color: #66512c;
            position: relative;
            float: bottom;
            top: 75%;
            left: 55%;
            transform: translate(-60%, 30%);
        }

        h3 {
            font-size: 30px;
            color: #ffffff;
            position: relative;
            float: bottom;
            top: 75%;
            left: 55%;
            transform: translate(-60%, 30%);
        }

        p {
            font-size: 16px;
            color: #3a87ad;
            position: relative;
            float: bottom;
            top: 75%;
            left: 53%;
            transform: translate(-55%, 30%);
            vertical-align: middle;
        }

        h1 {
            font-size: 16px;
            color: #3a87ad;
            position: relative;
            float: bottom;
            top: 75%;
            left: 55%;
            transform: translate(-55%, 30%);
        }

        .margin {
            margin-bottom: 45px;
        }

        .bg-1 {

            background-color: #ffab40;
            color: #ffffff;
        }

        img {
            background-size: cover;
            display: block;
            vertical-align: middle;

        }

        .imgalign {
            margin-left: auto;
            margin-right: auto;
            background-size: cover;
            display: block;
            vertical-align: middle;
        }

        .txtalign {
            margin-left: auto;
            margin-right: auto;
            vertical-align: middle;
            width: 8em
        }

        .bg-2 {
            background-color: #ffffff; /* Dark Blue */
            color: #ffffff;
        }

        .bg-3 {
            background-color: #f1f8e9; /* White */
            color: #555555;
        }

        .bg-4 {
            background-color: #0097a7; /* Black Gray */
            color: #fff;
        }

        .container-fluid {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .navbar {
            padding-top: 15px;
            padding-bottom: 15px;
            border: 0;
            border-radius: 0;
            margin-bottom: 0;
            font-size: 12px;
            letter-spacing: 5px;
        }

        .navbar-nav li a:hover {
            color: #1abc9c !important;
        }

        .col-sm-6 {
            display: block;
        }

        .containerimg {
            width: 100%;
            height: 40%;
            background: purple;
            margin: 0 auto;
            padding-top: 0px;
        }

        .containerimg img.wide {
            max-width: 100%;
            max-height: 100%;
            height: auto;
        }

        .containerimg img.tall {
            max-height: 100%;
            max-width: 100%;
            width: auto;
        }

        ​
        .footer {
            position: fixed;
            right: 0;
            bottom: 0px;
            left: 0;
            top: inherit;
            padding-top: -200px;
            text-align: center;
        }

        .navbar-nav > li > a {
            color: white;
            style: bold;
            font-size: 15px;
        }

        .main-navigation ul li a {
            padding-right: 25px !important;
            padding-left: 25px !important;
        }
    </style>
</head>
<body>
<script>
    var MON_CHAR = {{ config('variables.monthly_charge') }};
    var ANUAL_CHAR = {{ config('variables.annual_charge') }};
    var EXTRA_CHAR = {{ config('variables.extra_charge') }};
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/stripe.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="https://js.stripe.com/v2/"></script>
<div id="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>  Subscription </h1></div>
                <h2 style="text-align:center;"> </h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::open(['method'=> 'POST', 'action' => 'SubscriptionController@getIndex','id'=>'subscription-form']) }}
    <div class="container">
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

                                    <div class="panel-heading"><h1> Number of Locations & Type of Plan </h1></div>
                                </div>
                            </div>
                        <label class="control-label" for="user_locations">Number Of Locations</label>

                        <div class="col-md-6">
                            <input id="user_locations" type="text" class="form-control" name="user_locations"
                                   value="{{ old('user_locations') }}" placeholder="User locations" required
                                   autofocus>

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
                                <option value="monthly">Monthly</option>
                                <option value="annually">Annually</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6" style="padding-bottom: 12px;">
                    </div>
                    <div class="col-sm-12">
                        <label for="coupon" class="control-label">Coupon</label>
                        <div class="col-md-6" style="padding-left: 0px;">
                            <input id="coupon" type="text" class="form-control" name="coupon"
                                   value="{{ old('coupon') }}" placeholder="Coupon" required
                                   autofocus>

                            @if ($errors->has('coupon'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('coupon') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <div class="panel-heading"><h1>  Payment Details </h1></div>

                            <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox"/>
                                    Remember
                                </label>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="stripe-errors panel"></div>
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

                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                <input type="text" class="form-control" data-stripe="exp-month"
                                                       id="expiryMonth" placeholder="MM" maxlength="2" required/>
                                            </div>
                                            <div class="col-xs-6 col-lg-6 pl-ziro">
                                                <input type="text" class="form-control" data-stripe="exp-year"
                                                       id="expiryYear" placeholder="YY" maxlength="2" required/></div>
                                        </div>
                                        <span id="expiry_error" style="color: red; display: none;"></span>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label for="cvCode">
                                                CV CODE</label>
                                            <input type="password" class="form-control" data-stripe="cvc" maxlength="3"
                                                   id="cvCode"
                                                   placeholder="CV" required/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#"><span class="badge pull-right"><span
                                            class="glyphicon glyphicon-usd" id="result_final">0</span></span> Final
                                Payment</a>
                        </li>
                    </ul>
                    <br/>
                    <button class="btn btn-success btn-lg btn-block" type="button" id="button_pay">Pay</button>
                </div>
            </div>
        </fieldset>
    </div>
    {{form::token()}}
    {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
</body>