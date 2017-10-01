@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1> View Donation Request </h1></div><br>

                    <div class="col-md-offset-8 col-lg-offset-8 col-xs-offset-8 form-inline">
                        {{ Form::open(['method'=> 'GET', 'action' => 'DonationRequestController@searchDonationRequest']) }}
                        {{ Form::input('search','q', null, ['placeholder' => 'Requester Name...','class'=>'form-control', 'autocomplete'=>'off'])}}
                        {!! Form::submit('Search', ['class' => 'btn btn-default']) !!}
                        {{ Form::close() }}
                    </div> <br>

                    <div class="col-md-offset-8 col-lg-offset-8 col-xs-offset-8">
                        <a type="button" class="btn btn-primary" href="{{ action('DonationRequestController@index') }}">View All Donation Requests</a>
                    </div>

                    <div class="panel-body" style="text-align: center">
                        @if(sizeOf($donationrequests) != 0)
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">Requester</th>
                                <th class="text-center">Requester Type</th>
                                <th class="text-center">City</th>
                                <th class="text-center">State</th>
                                <th class="text-center">Zip Code</th>
                                <th class="text-center">Event Name</th>
                                <th colspan="2" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($donationrequests as $donationrequest)
                                <tr>
                                    <td>{{ $donationrequest->requester }}</td>
                                    <td>{{ $donationrequest->requester_type }}</td>
                                    <td>{{ $donationrequest->city }}</td>
                                    <td>{{ $donationrequest->state }}</td>
                                    <td>{{ $donationrequest->zipcode }}</td>
                                    <td>{{ $donationrequest->event_name }}</td>
                                    <td><a href="{{route('donationrequests.show',$donationrequest->id)}}" class="btn btn-primary"> Detail </a>
                                    <td><a href="{{route('donationrequests.edit',$donationrequest->id)}}" class="btn btn-warning"> Edit </a>
                                </tr>
                            @endforeach
                            {{$donationrequests->links()}}
                            </tbody>
                        </table>
                        @else
                            <p>No Donation Request is stored in the system yet.</p>
                        @endif
                        {{$donationrequests->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection