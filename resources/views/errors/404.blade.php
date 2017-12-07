@extends('layouts.app')

@section('content')

    <html>
    <head>
        <title>User not found.</title>
    </head>
    <body>
    <div style="display: flex; justify-content: center;">
    <img src="{{ asset('img/error.ico') }}" style="width: 20%; height: 20%;">
    </div>
    <p align="middle" style="font-size:30px">You encountered some Error !<br>
        Please go to the home page & try again !</p>
    </body>
    </html>
@endsection