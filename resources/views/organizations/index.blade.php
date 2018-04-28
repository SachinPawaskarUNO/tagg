@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:26px;">Business Locations</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
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
                            @if ($subscriptionQuantity =='101')
                                <div class="panel-heading">
                                    @if($subscriptionEnds == '')
                                        <a href="{{ URL::action('SubscriptionController@cancel') }}"
                                           class="btn backbtnsubs pull-right" style="" id="cancel">
                                            Cancel Subscription
                                        </a>
                                    @else
                                        <a href="{{ URL::action('SubscriptionController@resume') }}"
                                           class="btn backbtnsubs pull-right" style="" id="resume">
                                            Resume Subscription
                                        </a>
                                    @endif
                                    <span class="pull-right">&nbsp;&nbsp;&nbsp;</span>
                                    <h1 style="text-align: center;width: 50%;">Unlimited Locations can be added</h1>
                                </div>
                            @elseif ($count <= $subscriptionQuantity)
                                <div class="panel-heading">
                                    @if($subscriptionEnds == '')
                                        <a href="{{ URL::action('SubscriptionController@cancel') }}"
                                           class="btn backbtnsubs pull-right" style="" id="cancel">
                                            Cancel Subscription
                                        </a>
                                    @else
                                        <a href="{{ URL::action('SubscriptionController@resume') }}"
                                           class="btn backbtnsubs pull-right" style="" id="resume">
                                            Resume Subscription
                                        </a>
                                    @endif
                                    <h1 style="text-align: left;font-size:22px;">Your account allows
                                        for {{$subscriptionQuantity}} locations. You have used {{$count}}.</h1>

                                </div>
                            @else
                            <div class="alert alert-info">Plan limit includes the parent business and the limit is crossed, upgrade to add more locations.
                                </div>

                                <div class="panel-heading">
                                    @if($subscriptionEnds == '')
                                        <a href="{{ URL::action('SubscriptionController@cancel') }}"
                                           class="btn backbtnsubs pull-right" style="" id="cancel">
                                            Cancel Subscription
                                        </a>
                                    @else
                                        <a href="{{ URL::action('SubscriptionController@resume') }}"
                                           class="btn backbtnsubs pull-right" style="" id="resume">
                                            Resume Subscription
                                        </a>
                                    @endif
                                    <h1 style="text-align: center">Subscription made for {{$subscriptionQuantity}}
                                        locations</h1>
                                </div>
                            @endif

{{--  My Business div  --}}
                    </div>
                    <div class="panel-body">
                        <div class="panel-heading">
                            <h1 style="font-weight: bold;">My Business</h1>

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
                                                id = 'edit_location' class="btn btn-basic">Edit</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
{{--  Locations div  --}}
                        <div class="panel-heading">
                            <table width="100%">
                                <tr>
                                    <td align="left"><h1 style="font-weight: bold;">Business Locations</h1></td>
                                    <td align="right" style="padding-right: 10px;padding-top: 0px">
                                        @if ($subscriptionQuantity > '101' || $subscription !== 0)
                                            <a href="{{action('OrganizationController@createOrganization')}}"
                                               id = 'Add_locations' class="btn btn-basic">[+] Add Business Location </a>
                                        @endif</td>
                                </tr>

                            </table>
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
                                                    class="btn btn-basic">Edit</a>
                                        </td>
                                        <td style="vertical-align: middle">
                                            {{ Form::open([
                                                            'method' => 'DELETE',
                                                            'action' => ['OrganizationController@destroy', $organization->id]
                                                          ]) }}
                                            <input id = 'submit' type="submit" value="Inactivate" class='btn backbtn'
                                                   onClick="return confirm('Are you sure you want to inactivate the Business Location? \n\nALL users for this Location will be inactivated as well!\nIf you wish to keep these users, please press cancel and move them to a new location from the Users management page before removing the location.');">
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
