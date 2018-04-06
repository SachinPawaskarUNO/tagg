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
                        {!! Form::open(['action' => 'OrganizationController@create', 'class' => 'form-horizontal']) !!}
                        {{ csrf_field() }}
                        @include('organizations.form', ['submitButtonText' => 'Add Business Location'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
