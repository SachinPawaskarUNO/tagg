@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- will be used to show any messages -->
                @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="">Manage Business Locations </h1>
                        @if ($subscriptionQuantity=='101' || ($count < $subscription))
                            <a href="{{action('OrganizationController@createOrganization')}}" class="btn savebtn"
                               style="position: absolute; top: 26px; right:32px;background-color: #0099CC;">[+] Add
                                Business Location </a>

                        @endif

                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">

                            @if ($subscriptionQuantity=='101')
                                <div class="panel-heading">
                                    @if($subscriptionEnds == '')
                                        <a href="{{ URL::action('SubscriptionController@cancel') }}"
                                           class="btn backbtn pull-right" style="" id="cancel">
                                            Cancel Subscription
                                        </a>
                                    @else

                                        <a href="{{ URL::action('SubscriptionController@resume') }}"
                                           class="btn savebtn pull-right" style="" id="resume">
                                            Resume Subscription
                                        </a>
                                    @endif
                                    <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                                    <h1 style="text-align: center;width: 50%;">Unlimited Locations can be added</h1>
                                </div>
                            @elseif ($count < $subscription)
                                <div class="panel-heading">
                                    @if($subscriptionEnds == '')
                                        <a href="{{ URL::action('SubscriptionController@cancel') }}"
                                           class="btn backbtn pull-right" style="" id="cancel">
                                            Cancel Subscription
                                        </a>
                                    @else
                                        <a href="{{ URL::action('SubscriptionController@resume') }}"
                                           class="btn savebtn pull-right" style="" id="resume">
                                            Resume Subscription
                                        </a>
                                    @endif
                                    <h1 style="text-align: left;">Your account allows
                                        for {{$subscriptionQuantity}} locations. You have used {{$count + 1}}.</h1>

                                </div>
                            @else
                                <div class="alert alert-info">Plan limit includes the parent organization and the limit
                                    is
                                    crossed, upgrade to add more locations.
                                </div>

                                <div class="panel-heading">
                                    <h1 style="text-align: center">Subscription made for {{$subscriptionQuantity}}
                                        locations</h1>
                                </div>
                            @endif

                        </div>
                        <div class="panel-heading">
                            <h1>My Business</h1>

                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th class="text-center">Parent Business</th>
                                    <th class="text-center">Business Description</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Monthly Budget</th>
                                    <th class="text-center" colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{ $loggedOnUserOrganization[0]->org_name }}</td>

                                    <td style="vertical-align: middle">{{ $loggedOnUserOrganization[0]->org_description }}</td>
                                    <td style="vertical-align: middle">{{ $loggedOnUserOrganization[0]->street_address1 }}
                                        {{ $loggedOnUserOrganization[0]->street_address2 }}
                                        , {{ $loggedOnUserOrganization[0]->city }}
                                        , {{ $loggedOnUserOrganization[0]->state }} {{ $loggedOnUserOrganization[0]->zipcode }}</td>
                                    <td style="vertical-align: middle">{{ $loggedOnUserOrganization[0]->phone_number}}</td>
                                    <td style="vertical-align: middle">{{'$'}}{{ $loggedOnUserOrganization[0]->monthly_budget}}</td>
                                    <td style="vertical-align: middle"><a
                                                href="{{route('organizations.edit',encrypt($loggedOnUserOrganization[0]->id))}}"
                                                class="btn savebtn" style="background-color: #0099CC;">Edit</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="panel-heading">
                            <h1>Business Locations</h1>
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th class="text-center">Business Name</th>
                                    <th class="text-center">Business Description</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Phone Number</th>
                                    <th class="text-center">Monthly Budget</th>
                                    <th class="text-center" colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($childOrganizations as $organization)



                                    <tr class="text-center">
                                        <td style="vertical-align: middle">{{ $organization['org_name'] }}</td>
                                        <td style="vertical-align: middle">{{ $organization['org_description'] }}</td>
                                        <td style="vertical-align: middle">{{ $organization['street_address1'] }}
                                            {{ $organization['street_address2'] }}
                                            , {{ $organization['city'] }}
                                            , {{ $organization['state'] }} {{ $organization['zipcode'] }}</td>
                                        <td style="vertical-align: middle">{{ $organization['phone_number']}}</td>
                                        <td style="vertical-align: middle">{{'$'}}{{ $organization['monthly_budget']}}</td>
                                        <td style="vertical-align: middle"><a
                                                    href="{{route('organizations.edit',encrypt($organization->id))}}"
                                                    class="btn savebtn">Edit</a>
                                        </td>
                                        <td style="vertical-align: middle">
                                            {{ Form::open([
                                                            'method' => 'DELETE',
                                                            'action' => ['OrganizationController@destroy', $organization->id]
                                                          ]) }}
                                            <input type="submit" value="Delete" class='btn backbtn'
                                                   onClick="return confirm('Are you sure you want to delete the Business Location? \n\nALL users for this Location will be inactivated!\nIf you wish to keep these users, please press cancel and move them to a new location from the Users management page before removing the location.');">
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
    </div>
@endsection
@section('scripts')
    <script>

        $(document).on('click', '#cancel', function () {

            $(this).addClass('disabled');

        });
        $(document).on('click', '#resume', function () {
            $(this).addClass('disabled');
        });

    </script>
@endsection
