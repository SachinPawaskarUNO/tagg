@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <input name="_token" type="hidden" id="_token" value="{{ csrf_token() }}" />
        @if(Session::has('flash_message'))
            <div class="col-md-8 alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="text-align: left;">  View & Update Profile </h1></div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Phone Number</th>
                                <th colspan="3" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td style="vertical-align: middle">{{ $user->email }}</td>
                                    <td style="vertical-align: middle">{{ $user->street_address1 }} {{ $user->street_address2 }}, {{ $user->city }}, {{ $user->state }} {{ $user->zipcode }}</td>
                                    <td style="vertical-align: middle">{{ $user->phone_number }}</td>
                                    <td style="vertical-align: middle"><a href="{{action('UserController@editProfile')}}" class="btn btn-basic"> Edit </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
