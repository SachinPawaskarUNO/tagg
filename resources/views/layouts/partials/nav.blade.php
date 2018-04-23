    <nav class="navbar-toggleable-md navbar-toggleable-xs navbar-findcond navbar-fixed-top bg-light">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><img src="{{ asset('img/newlogo.png') }}" alt="{{ env('APP_NAME', 'CharityQ')  }}"
                            id="logo" class="img-responsive"></a>
                </div>
                     <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    {{-- <div class="col-sm-9 col-md-offset-3" style='position:absolute;right: 0px;top:0px;'> --}}
                        {{-- <div class="collapse navbar-collapse" id="myNavbar" style="padding-right:35px;" > --}}
                            <!-- Right Side Of Navbar -->
                            {{-- <ul class="nav navbar-nav navbar-right visible-md-block visible-lg-block"> --}}
                            <ul class="nav navbar-nav navbar-right">
                                @if (Auth::guest())
                                    <li><a href="{{ url('/') }}#about" >About Us</a></li>
                                    <li><a href="{{ url('/') }}#how" >Contact us</a></li>
                                    <li><a href="{{ url('/') }}#generic_price_table" >Pricing</a></li>
                                    <li><a href="{{ route('register') }}" >Sign Up</a></li>
                                    <li><a href="{{ route('login') }}" >Login&nbsp;<span class="glyphicon glyphicon-log-in"></span></a></li>
                            </ul>
                        
                        @elseif (
                                (Auth::user()->organization
                                              ->trial_ends_at >= \Carbon\Carbon::now())
                            OR  (Auth::user()->organization
                                             ->parentOrganization->isNotEmpty() 
                            AND  Auth::user()->organization
                                             ->parentOrganization[0]
                                             ->parentOrganization
                                             ->trial_ends_at >= \Carbon\Carbon::now())
                                )
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{{ url('/dashboard')}}" id='Dashboard'>Dashboard</a>
                                </li>
                                @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                <li><a href="{{url('/organizations/donationurl',encrypt(Auth::user()->organization_id) )}}" id = 'MyDonationForm' 
                                    >My Donation Form</a></li>    
                                <li><a href="{{ route('donationrequests.index')}}" id = 'searchDonations'>Search Donations</a></li>
                                @elseif(Auth::user()->roles[0]
                                                    ->id == \App\Custom\Constant::TAGG_ADMIN 
                                        OR 
                                        Auth::user()->roles[0]
                                                    ->id == \App\Custom\Constant::TAGG_USER 
                                        OR 
                                        Auth::user()->roles[0]
                                                    ->id == \App\Custom\Constant::ROOT_USER
                                        )
                                    <li><a href="{{ URL('donationrequests/admin')}}" id='searchDonations'>Search Donations</a></li>
                                @endif
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        My Business
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        {{-- <div class="w3-dropdown-content w3-card-4 w3-bar-block"> --}}
                                            {{-- @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER) --}}
                                            {{-- only admin can see donation preferences --}}
                                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN)
                                                <li>
                                                    <a href="{{ url('/rules')}}">Donation Preferences</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/donationrequests/create') }}?orgId={{encrypt(Auth::user()->organization_id)}}" target="_blank">Manual Donation Request</a>
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
                                    </ul>
                                </li>


                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                        <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ action('UserController@editProfile')}}">User Profile</a></li>
                                        <li><a href="{{ route('reset-password') }}">Change Password</a></li>
                                        <li><a href="{{ route('logout') }}" 
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        @else
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{{ url('/subscription')}}"
                                    >Subscription</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
