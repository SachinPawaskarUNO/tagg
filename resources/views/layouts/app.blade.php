<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials.head')
    @yield('header')
</head>

<body>

@yield('scripts')

@if(Auth::guest() && Route::is('donationrequests.create*'))

@else
    @include('layouts.partials.nav')
@endif

@yield('content')

</body>
</html>
