<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Tagg</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>


<style>
    .body {
        padding:10px;
        padding-bottom:60px;
    }
</style>
    <div class="body">
    <div id="app">
        <div class="panel panel-default">
        <nav class="navbar navbar-default navbar-fixed-top">
            <a href="{{route('home')}}">
                <img src="http://www.togetheragreatergood.com/wp-content/uploads/2016/06/Tagg_Logo.png" alt="TAGG" id="logo" height="85	" width="136"  />
               </a>

            <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><h3>Login</h3></a></li>
                            <li><a href="{{ route('register') }}"><h3>Register</h3></a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
             </nav>
            </div>
            </div>
</div>

    <div>
        <br><br>
    </div>

        @yield('content')



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

</html>
