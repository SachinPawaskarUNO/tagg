@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <br>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: left;font-size:22px;">Add Location</h1>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(['action' => 'OrganizationController@create', 'class' => 'form-horizontal', 'id' => 'loc']) !!}
                        {{ csrf_field() }}
                        @include('organizations.form', ['submitButtonText' => 'Add Business Location'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $('#monthly_budget').val();
    $("#monthly_budget").keyup(function () {
        new_val = $("#monthly_budget").val().replace(/[^0-9\.]/g, '');
        new_val = parseInt(new_val);
        new_val_formatted = new_val.toLocaleString("en");
        if (new_val_formatted != 'NaN') {
            $('#monthly_budget').val(new_val_formatted);
        }
        else {
            $('#monthly_budget').val('');
        }
    });

    $('#loc').submit( function() {
    var m = $('#monthly_budget').val();
    m = m.replace(/,/g, "");
    $('#monthly_budget').val(m);
        });
   </script>
@endsection
