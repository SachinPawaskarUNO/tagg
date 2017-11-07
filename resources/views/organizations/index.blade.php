@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif

                <div class="panel panel-default">

                    <div class="panel-heading"><a href="{{action('OrganizationController@createOrganization')}}" class="btn btn-primary pull-right">
                            [+] Add </a><h1> Manage Business Locations </h1>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">Organization Name</th>
                                <th class="text-center">Organization Type</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center" colspan="2">Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($childOrganizations as $organization)
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{ $organization->organization['org_name'] }}</td>
                                    <td style="vertical-align: middle">{{ $organization->organization->organizationType->type_name }}</td>
                                    <td style="vertical-align: middle">{{ $organization->organization['street_address1'] }}
                                        {{ $organization->organization['street_address2'] }}
                                        , {{ $organization->organization['city'] }}
                                        , {{ $organization->organization['state'] }} {{ $organization['zipcode'] }}</td>
                                    <td style="vertical-align: middle">{{ $organization->organization['phone_number']}}</td>
                                    <td style="vertical-align: middle"><a href="{{route('organizations.edit',$organization->child_org_id)}}" class="btn btn-warning">Edit</a></td>
                                    <td style="vertical-align: middle">
                                        {{ Form::open([
                                                        'method' => 'DELETE',
                                                        'action' => ['OrganizationController@destroy', $organization->child_org_id]
                                                      ]) }}
                                        <input type="submit" value="Delete" class = 'btn btn-danger' onClick="return confirm('Are you sure you want to delete the Business Location?');">
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection