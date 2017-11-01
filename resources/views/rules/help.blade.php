<!DOCTYPE html>
<html lang="en">
@extends('layouts.app')
@section('header')

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('querybuilder/jquery/dist/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('querybuilder/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>

@endsection
@section('content')
  <body>
    <div class="container">
<h1></h1>
  <div>
  <h4>

    <iframe src="{{ asset('files/business_rules_help.pdf') }}"width="100%" height="670px" scrolling="Yes" style=" border:solid;"></iframe></li>


</h4>

</div>
</div>

</body>
</html>

@endsection
