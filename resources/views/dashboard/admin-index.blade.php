@extends('layouts.app')

@section('content')

    <div id="wrapper">
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">CHARITYQ DASHBOARD (YTD)</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading" style="background-color: #d4c8b8;">
                        <div class="row">
                            <table border="0" style="color: white;font-size: 15px;">
                                <tr>
                                    <td rowspan="3">
                                        <div class="col-xs-3" style="padding-bottom: 15px;">
                                            <i class="fa fa-envelope-open fa-5x"></i>
                                        </div>
                                    </td>
                                    <td><div style="font-weight: bold"> REQUESTS APPROVED : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($approvedNumber) }}</div></td>
                                </tr>
                                <tr>
                                    <td><div style="font-weight: bold;"> REQUESTS REJECTED : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($rejectedNumber) }}</div></td>

                                </tr>
                                <td><div style="font-weight: bold;"> REQUESTS PENDING : </div></td>
                                <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($pendingNumber) }}</div></td>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading" style="background-color: #b69da8;">
                            <div class="row">
                                <table border="0" style="color: white;font-size: 15px;">
                                <tr>
                                    <td rowspan="3">
                                        <div class="col-xs-3" style="padding-bottom: 15px;">
                                            <i class="fa fa-university fa-5x"></i>
                                        </div>
                                    </td>
                                    <td><div style="font-weight: bold">AVG AMOUNT DONATED : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">${{ number_format($avgAmountDonated)}}</div></td>
                                </tr>
                                <tr>
                                    <td><div style="font-weight: bold;"> ACTIVE CUSTOMERS :</div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($userCount) }}</div></td>

                                </tr>
                                    <td><div style="font-weight: bold;"> ACTIVE LOCATIONS :</div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($numActiveLocations) }}</div></td>


                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-4 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading" style="background-color: #a5c5bd;">
                            <div class="row">
                                <table border="0" style="color: white;font-size: 15px;">
                                    <tr>
                                        <td rowspan="3">
                                            <div class="col-xs-3" style="padding-bottom: 15px;">
                                                <i class="fa fa-line-chart fa-5x"></i>
                                            </div>
                                        </td>
                                        <td><div style="font-weight: bold"> NEW BUSINESSES THIS WEEK : </div></td>
                                        <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($userThisWeek) }}</div></td>
                                    </tr>
                                    <tr>
                                        <td><div style="font-weight: bold;"> NEW BUSINESSES THIS MONTH : </div></td>
                                        <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format($userThisMonth) }}</div></td>
                                    </tr>
                                    <td><div style="font-weight: bold;"> NEW BUSINESSES THIS YEAR : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ number_format ($userThisYear) }}</div></td>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">

                <!-- /.col-lg-8 -->
                <div class="col-lg-12">
                    <div class="panel panel-default text-left">
                        <div class="panel-heading text-center" style="color:#0077aa;font-size:15px;">
                            <b>DONATIONS SUMMARY (CUSTOMERS)</b>
                        </div>

                        <div class="panel-body table-wrap wrapper">
                            @if(sizeOf($organizations) != 0)
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" style=>
                                    <thead>
                                        <tr class="bg-info">
                                            <th class="text-center">Customer Name</th>
                                            <th class="text-center">Amount Requested</th>
                                            <th class="text-center">Amount Approved</th>
                                            <th class="text-center">Approved</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Details</th>
                                        </tr>
                                    </thead>
                                    <?php $cancelled = false ?>
                                    <tbody  style="text-align: center">
                                        @foreach ($organizations as $organization)
                                            @if(is_null($organization->created_at))
                                                @continue;
                                            @endif
                                            @foreach ($subscriptions as $subscription)
                                                @if($subscription->organization_id == $organization->id)
                                                    <?php $cancelled = is_null($subscription->ends_at) ? false : true && $subscription->ends_at>=(\Carbon\Carbon::now()) ?>

                                                @endif
                                            @endforeach
                                            <tr>
                                                <td style="vertical-align: middle">{{ $organization->org_name }}</td>
                                                <td style="vertical-align: middle">${{ number_format($organization->approvedDonationRequest->sum('dollar_amount')) }}</td>
                                                <td style="vertical-align: middle">${{ number_format($organization->approvedDonationRequest->where('approval_status_id', \App\Custom\Constant::APPROVED)->where('updated_at', '>', \Carbon\Carbon::now()->startOfYear())->sum('approved_dollar_amount'))}} </td>
                                                <td style="vertical-align: middle">{{ $organization->approvedDonationRequest->where('approval_status_id', \App\Custom\Constant::APPROVED)->count() }}</td>
                                                    @if(is_null($organization->trial_ends_at) )
                                                         <?php $status = 'Incomplete' ?>
                                                    @elseif(!is_null($organization->trial_ends_at) && !is_null($organization->stripe_id) && $organization->trial_ends_at>=(\Carbon\Carbon::now()))
                                                        <?php $status = 'Active' ?>
                                                    @else
                                                    <?php $status = 'Cancelled' ?>
                                                    @endif
                                                    @if(strpos($organization->error_message, 'declined') !== false)
                                                        <?php $status = 'Declined' ?>
                                                    @endif
                                                    @if($cancelled)
                                                        <?php $status = 'Active' ?>
                                                    @endif
                                                <td style="vertical-align: middle">{{$status }}</td>
                                                <td>
                                                    @if($status != 'Incomplete' && !is_null($organization->trial_ends_at))
                                                    <a id='details' href="{{ url('/organizationdonations', encrypt($organization->id))}}"
                                                       class="btn btn-info" title="Detail">
                                                        <span class="glyphicon glyphicon-list-alt"></span></a>
                                                    @endif
                                                </td>
                                                {{--  <td style="vertical-align: middle"><a href="{{route('donationrequests.show',$donationrequest->id)}}" class="btn savebtn"> Detail </a>
                                                                                    <td style="vertical-align: middle"><a href="{{route('donationrequests.edit',$donationrequest->id)}}" class="btn savebtn"> Edit </a>  --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div>No pending donation requests to show.</div>
                            @endif

                        </div>

                        <!-- Donation request -->
                        <!-- /.panel -->
                    </div>

                    <!-- /.col-lg-4 -->
                </div>

                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <script>
            $(document).ready(function() {
                $('#example').DataTable(
                    {
                        responsive: true
                    } 
                );
            } );
        </script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    </div>
@endsection
