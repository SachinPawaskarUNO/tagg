<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ env('APP_NAME', 'CharityQ')  }}</title>
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
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


    @yield('css')


    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('header')
    <style>
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 40px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .full-height {
            height: 80vh;
        }

        body {
            font: 16px Montserrat, sans-serif;
            font-size: small;
            line-height: 2.0;
            color: #0077aa;
            margin-bottom: 100px;
            min-height: 100%;
            clear: both;
            margin-top: 20px;
            padding: 25px 0 0;
            overflow-x: hidden;

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

        h4 {
            font-size: 30px;
            color: red;
            position: relative;
            float: bottom;
            top: 75%;
            left: 55%;
            transform: translate(-60%, 30%);
            text-decoration-line: underline;
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
            font-size: 20px;
            color: black;
            position: relative;
            float: bottom;
            top: 75%;
            left: 53%;
            transform: translate(-55%, 30%);
            vertical-align: middle;
            text-align: center;
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

            background-color: #90a4ae;
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

        .navbar-fixed-top {
            box-shadow: 1px 1px 5px 2px mediumpurple;
            max-height: 7%;
        }

        .navbar-nav li a:hover {
            color: #1abc9c !important;
        }

        .navbar-nav li a:active {
            background-color: #e1bee7 !important;
        }

        .btn {
            align: center;
            border: none;
            padding: 5px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
        }

        .savebtn {
            background-color: #0099CC;
            color: white;
            padding: 5px 12px;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
        }

        .updatebtn {
            background-color: #00C851;
            color: white;
            padding: 5px 12px;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
        }

        .backbtn {
            background-color: #ffbb33;
            color: white;
        }

        .col-sm-6 {
            display: block;
            padding: 5px;

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
            vertical-align: middle;

        }

        .main-navigation ul li a {

            padding-left: 25px !important;
            padding-top: 25px;
        !important;
            padding-bottom: 25px;
        !important;
            color: white;
        }

        .w3-bar .w3-button {
            padding: 10px 16px 16px;
        }

        body, h1, h2, h3, h4, h5, h6 {
            font-family: "Raleway", sans-serif
        }

        body, html {
            /*height: 100%;*/
            line-height: 1.8;
        }

        .divsmall {
            padding: 25px -5px 5px 100px;

        }

        div {
            padding: 1px;
        }

        .dropdown-menu a {
            background-color: #9c27b0;
            padding: 2px 3px;
            color: white;
            text-decoration: none;
            display: block;
            border: 1px solid #e1bee7;
            box-shadow: 1px 1px 5px 1px grey;
            float: none;
            overflow: hidden;

        }

        .dropdown-menu li > a {
            color: white;
            padding-right: 3px;
            padding-bottom: 0px;
            padding-left: 3px;
            float:none;
            overflow: hidden;
        }
        .dropdown-menu {

            padding: 0;
            padding-bottom: 0px;
            padding-top: 0px;
            text-align: left;
            float:none;
            overflow: hidden;
            font-weight: bold;
        }
        .dropdown-menu > li{

            text-align:left;
        }
        .panel-body{
            overflow-x: auto;
                    }
        th,td{
            min-width:20px;
        }

    </style>
</head>


<body>

@yield('scripts')
<div id="app">


    <nav class="navbar-toggleable-md navbar-toggleable-xs navbar-light navbar-fixed-top"
         style="background-color: #8e24aa;padding-bottom: .5px;margin-bottom: 10px">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-3"
                     style='padding-left: 0px;padding-top: .5px;padding-bottom: -5px;padding-right:10px;margin-top: -2px;margin-bottom: -0.5px'>
                    @if (Auth::guest())
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                                 id="logo" class="img-responsive"
                                 width="60%" style='background-size: inherit'/>
                        </a>
                    @elseif ((Auth::user()->organization->trial_ends_at >= \Carbon\Carbon::now())
                    OR ( Auth::user()->organization->parentOrganization->isNotEmpty() AND  Auth::user()->organization->parentOrganization[0]->parentOrganization->trial_ends_at >= \Carbon\Carbon::now()))
                        <a href="{{ url('/dashboard') }}">
                            <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                                 id="logo" class="img-responsive"
                                 width="60%" style='background-size: inherit'/>
                        </a>

                    @else
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                                 id="logo" class="img-responsive"
                                 width="60%" style='background-size: inherit'/>
                        </a>
                    @endif


                </div>
                <div class="col-sm-9 col-md-offset-3" style='position:absolute;right: 0px;top:0px;'>
                    <div class="collapse navbar-collapse" id="myNavbar" style="padding-right:35px;" >
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">

                            @if (Auth::guest())
                                <li><a href="{{ url('/') }}#about" class="w3-bar-item w3-button">About Us&nbsp;<span
                                                class="glyphicon glyphicon-info-sign"></span></a></li>
                                <li><a href="{{ url('/') }}#how" class="w3-bar-item w3-button">How This Works&nbsp;<span
                                                class="glyphicon glyphicon-question-sign"></span></a></li>
                                <li><a href="{{ route('register') }}" class="w3-bar-item w3-button">Sign Up <span
                                                class="glyphicon glyphicon-user"></span></a></li>
                                <li><a href="{{ route('login') }}" class="w3-bar-item w3-button ">Login&nbsp;<span
                                                class="glyphicon glyphicon-log-in"></span></a></li>


                        </ul>
                    </div>
                    @elseif ((Auth::user()->organization->trial_ends_at >= \Carbon\Carbon::now())
                    OR ( Auth::user()->organization->parentOrganization->isNotEmpty() AND  Auth::user()->organization->parentOrganization[0]->parentOrganization->trial_ends_at >= \Carbon\Carbon::now()))
                        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">
                            <li><a href="{{ url('/dashboard')}}" class="w3-bar-item w3-button current"
                                   style="font-weight:bold; right:10px">Dashboard</a>
                            </li>
                            <li><a href="{{url('/organizations/invitecode',encrypt(Auth::user()->organization_id) )}}" class="w3-bar-item w3-button current"
                                   style="font-weight:bold; right:10px">Invite Code</a>
                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                <li><a href="{{ route('donationrequests.index')}}" class="w3-bar-item w3-button "
                                       style="font-weight:bold; right:10px">Search
                                        Donations</a></li>
                            @elseif(Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_USER OR Auth::user()->roles[0]->id == \App\Custom\Constant::ROOT_USER)
                                <li><a href="{{ URL('donationrequests/admin')}}" class="w3-bar-item w3-button "
                                       style="font-weight:bold; right:10px">Search
                                        Donations</a></li>
                            @endif
                            <li>
                                <a href="#" class="dropdown-toggle" style="font-weight:bold; right: 10px;"
                                   data-toggle="dropdown" role="button"
                                   aria-expanded="false">
                                    My Business
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                            <li>
                                                <a href="{{ url('/rules?rule=1')}}">Donation Preferences</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('/donationrequests/create') }}?orgId={{encrypt(Auth::user()->organization_id)}}">Manual Donation Request</a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{route('organizations.edit',encrypt(Auth::user()->organization_id) )}}">Business
                                                Profile</a>
                                        </li>
                                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::ROOT_USER OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN)
                                            <li>
                                                <a href="{{ url('user/manageusers')}}">Users</a>
                                            </li>
                                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                                <li>
                                                    <a href="{{ route('organizations.index')}}">Business Locations</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('emailtemplates.index') }}">
                                                    Email Templates
                                                </a>
                                            </li>
                                        @endif
                                    </div>
                                </ul>
                            </li>

                            {{--this is the one showing for nav bar--}}

                            <li>

                                <a href="#" class="dropdown-toggle" style="font-weight:bold;right:10px;"
                                   data-toggle="dropdown"
                                   role="button"
                                   aria-expanded="false">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span
                                            class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                    <li>
                                        <a href="{{ action('UserController@editProfile')}}">User Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('reset-password') }}">
                                            Change Password
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    </div>
                                </ul>

                            </li>
                        </ul>
                    @else
                        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">
                            <li><a href="{{ url('/subscription')}}"
                                   class="w3-bar-item w3-button current">Subscription</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>


<div id="navDemo" class="divsmall visible-xs-block visible-sm-block">
    @if (Auth::guest())

        <ul>
            <li><a href="{{ url('/') }}#about" class="w3-bar-item w3-button">About Us&nbsp;<span
                            class="glyphicon glyphicon-info-sign"></span></a></li>
            <li><a href="{{ url('/') }}#how" class="w3-bar-item w3-button">How This Works&nbsp;<span
                            class="glyphicon glyphicon-question-sign"></span></a></li>
            <li><a href="{{ route('register') }}" class="w3-bar-item w3-button">Sign Up <span
                            class="glyphicon glyphicon-user"></span></a></li>
            <li><a href="{{ route('login') }}" class="w3-bar-item w3-button ">Login&nbsp;<span
                            class="glyphicon glyphicon-log-in"></span></a></li>
        </ul>
    @elseif ((Auth::user()->organization->trial_ends_at >= \Carbon\Carbon::now())
                   OR ( Auth::user()->organization->parentOrganization->isNotEmpty() AND  Auth::user()->organization->parentOrganization[0]->parentOrganization->trial_ends_at >= \Carbon\Carbon::now()))

              <ul class="divsmall visible-xs-block visible-sm-block">
            <li><a href="{{ url('/dashboard')}}" class="w3-bar-item w3-button current">Dashboard</a></li>
            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                <li><a href="{{ route('donationrequests.index')}}" class="w3-bar-item w3-button">Search
                        Donations</a></li>
            @elseif(Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_USER)
                <li><a href="{{ URL('donationrequests/admin')}}" class="w3-bar-item w3-button">Search
                        Donations</a></li>
            @endif
            <li class="dropdown">
                <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        My Business
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                            <li>
                                <a href="{{ url('/rules?rule=1')}}">Donation Preferences</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('organizations.edit',encrypt(Auth::user()->organization_id))}}">Business
                                Profile</a>
                        </li>
                        @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::ROOT_USER OR Auth::user()->roles[0]->id == \App\Custom\Constant::TAGG_ADMIN)
                            <li>
                                <a href="{{ url('user/manageusers')}}">Users</a>
                            </li>
                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                <li>
                                    <a href="{{ route('organizations.index')}}">Business Locations</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('emailtemplates.index') }}">
                                    Email Templates
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>

            <li class="dropdown">
                <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span
                                class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ action('UserController@editProfile')}}">User Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('reset-password') }}">
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    @else
        <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">
            <li><a href="{{ url('/subscription')}}"
                   class="w3-bar-item w3-button current">Subscription</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    @endif
</div>
<div id="content">
    {{--@include('layouts.partials._status')--}}
    @yield('content')
</div>


{{--<script src="{{ asset('js/app.js') }}">--}}

</body>
<!-- <footer class="footer bg-4">

    <img src="{{ asset('img/icon-partner.png') }}" class="imgalign"  style="width:100px;height:50px;"  >

    <h5>A {{ env('APP_NAME', 'CharityQ')  }} Intiative</h5>
 </footer> -->
