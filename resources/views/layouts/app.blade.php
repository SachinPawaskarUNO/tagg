<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials.head')
    @yield('header')
</head>

<body>

@yield('scripts')

@include('layouts.partials.nav')

@yield('content')

</body>
</html>