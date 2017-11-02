@extends('layouts.app')

@section('content')
<body>
  <div class="container">
    <div>
      <h4>
        <iframe src="{{ asset('files/business_rules_help.pdf') }}" width="100%" height="670px" scrolling="Yes" style=" border:solid;"></iframe>
      </h4>
    </div>
  </div>
</body>

@endsection
