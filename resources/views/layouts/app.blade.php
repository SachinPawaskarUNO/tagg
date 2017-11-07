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
            margin-bottom:100px;
            padding:0;
            min-height: 100%;
            position:relative;
            clear: both;
        }
        @media screen and (max-width: 600px){
            ul.topnav li.right,
            ul.topnav li {float: none;}
        }
        h2
        {
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

        h3
        {
            font-size: 30px;
            color: #ffffff;
            position: relative;
            float: bottom;
            top: 75%;
            left: 55%;
            transform: translate(-60%, 30%);
        }

        p {font-size: 16px;
            color: #3a87ad;
            position: relative;
            float: bottom;
            top: 75%;
            left: 53%;
            transform: translate(-55%, 30%);
            vertical-align: middle;
        }
        h1 {font-size: 16px;
            color: #3a87ad;
            position: relative;
            float: bottom;
            top: 75%;
            left: 55%;
            transform: translate(-55%, 30%);
        }

        .margin {margin-bottom: 45px;}
        .bg-1 {

            background-color: #ffab40;
            color: #ffffff;
        }

        img {
            background-size: cover;
            display: block;
            vertical-align: middle;

        }


        .imgalign
        {
            margin-left: auto;
            margin-right: auto;
            background-size: cover;
            display: block;
            vertical-align: middle;
        }

        .txtalign
        {
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
        .navbar-nav  li a:hover {
            color: #1abc9c !important;
        }
        .col-sm-6
        {display: block;
           padding:5px;

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
        }​

        .footer {
            position: fixed;
            right: 0;
            bottom: 0px;
            left: 0;
            top: inherit;
            padding-top: -200px;
            text-align: center;
        }
        .navbar-nav > li >a{
            color:white;
            style:bold;
            font-size: 15px;
        }

        .main-navigation ul li a {
            padding-right: 25px !important;
            padding-left: 25px !important;
        }

        .w3-bar .w3-button {
            padding: 16px;
        }
        body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
        body, html {
            height: 100%;
            line-height: 1.8;
        }




    </style>
</head>


<body>
<script>
    var MON_CHAR = {{ config('variables.monthly_charge') }};
    var ANUAL_CHAR = {{ config('variables.annual_charge') }};
    var EXTRA_CHAR = {{ config('variables.extra_charge') }};
</script>
@yield('scripts')
<div id="app">


    <nav class="navbar-toggleable-md navbar-light primarybg-" style="background-color: #8e24aa;padding-bottom: .5px">
        <div class="container-fluid">



            <div class="row">
                <div class="col-sm-3" style='padding-left: 0px;padding-top: 0.5px'>




               <a href="{{ url('/') }}" >
                   <img src="{{ asset('img/CharityQ_Logo.png') }}" alt="TAGG" id="logo"  class="img-responsive" width="60%" style='background-size: inherit'/>

               </a>
                </div>
                <div class="col-sm-9 col-md-offset-3" style='position:absolute;right: 0px;top:0px;' >
                    <div class="collapse navbar-collapse" id="myNavbar" >


                                               <!-- Right Side Of Navbar -->
                      <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block">

                            @if (Auth::guest())
                                <li><a href="{{ url('/') }}#about" class="w3-bar-item w3-button">About Us</a></li>
                                <li><a href="{{ url('/') }}#how" class="w3-bar-item w3-button">How This Works</a></li>
                                <li><a href="{{ url('/') }}#sign" class="w3-bar-item w3-button">Sign Up !</a></li>
                                <li><a href="{{ route('login') }}" class="w3-bar-item w3-button ">Login</a></li>


                               </ul>
                                </div>

                                </li>
                                    @else

                                <li><a href="{{ url('/dashboard')}}" class="w3-bar-item w3-button current">Dashboard</a></li>
                                <li><a href="{{ route('donationrequests.index')}}" class="w3-bar-item w3-button ">Search Donations</a></li>
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false">
                                        My Organization
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <div class="w3-dropdown-content w3-card-4 w3-bar-block">
                                        <li>
                                            <a href="{{ url('/rules?rule=1')}}">Donation Preference</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('organizations.index')}}">Business Locations</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('emailtemplates.index') }}">
                                                Communication Template
                                            </a>
                                        </li>
</div>
                                    </ul>
                                </li>

                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<span
                                                class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ route('users.index')}}">Profile Management</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('reset-password') }}">
                                                Reset Password
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

                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
    </nav>
        </div>

   </div>
</div>


<div id="navDemo" class="visible-xs-block visible-sm-block">
    @if (Auth::guest())
        <li> <a href="{{ url('/') }}#about" class="w3-bar-item w3-button">About Us</a></li>
        <li><a href="{{ url('/') }}#how" class="w3-bar-item w3-button">How This Works</a></li>
        <li><a href="{{ url('/') }}#sign" class="w3-bar-item w3-button">Sign Up !</a></li>
        <li><a href="{{ route('login') }}" class="w3-bar-item w3-button ">Login</a></li>

                </div>
            </ul>
        </li>
    @else
<ul>
        <li><a href="{{ url('/dashboard')}}" class="w3-bar-item w3-button current">Dashboard</a></li>
        <li><a href="{{ route('donationrequests.index')}}" class="w3-bar-item w3-button ">Search Donations</a></li>
        <li  class="dropdown">
            <div class="w3-dropdown-content w3-card-4 w3-bar-block">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-expanded="false">
                My Organization
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">

                    <li>
                        <a href="{{ url('/rules?rule=1')}}">Donation Preference</a>
                    </li>
                    <li>
                        <a href="{{ route('organizations.index')}}">Business Locations</a>
                    </li>
                    <li>
                        <a href="{{ route('emailtemplates.index') }}">
                            Communication Template
                        </a>
                    </li>
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
                        <a href="{{ route('users.index')}}">Profile Management</a>
                    </li>
                    <li>
                        <a href="{{ route('reset-password') }}">
                            Reset Password
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
        @endif


</div>
</div>
</div>
</div>
</div>
</div>
<br>
    <div id="content">
        {{--@include('layouts.partials._status')--}}
        @yield('content')
    </div>

</div>


{{--<script src="{{ asset('js/app.js') }}">--}}

</body>
   <!-- <footer class="footer bg-4">

    <img src="{{ asset('img/icon-partner.png') }}" class="imgalign"  style="width:100px;height:50px;"  >

    <h5>A tagg Intiative</h5>
 </footer> -->




