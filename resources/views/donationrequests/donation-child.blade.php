@extends('layouts.app')

@section('content')

    <div id="wrapper">
        <!-- Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Dashboard
                        for {{ $parentOrgName }}</h1>
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
                                    <td><div style="font-weight: bold"> REQUESTS APPROVED :  </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $approvedNumber }}</div></td>
                                </tr>
                                <tr>
                                    <td><div style="font-weight: bold;"> REQUESTS REJECTED : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $rejectedNumber }}</div></td>
                                </tr>
                                <td><div style="font-weight: bold;"> REQUESTS PENDING :</div></td>
                                <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $pendingNumber }}</div></td>
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
                                            <i class="fa fa-line-chart fa-5x"></i>
                                        </div>
                                    </td>
                                    <td><div style="font-weight: bold"> AVG AMOUNT DONATED : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">${{ $avgAmountDonated }}</div></td>
                                </tr>
                                <tr>
                                    <td><div style="font-weight: bold;"> ACTIVE USERS :  </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $activeUsers }}</div></td>
                                </tr>
                                <td><div style="font-weight: bold;"> ACTIVE LOCATIONS : </div></td>
                                <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $numActiveLocations }}</div></td>
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
                                            <i class="fa fa-university fa-5x"></i>
                                        </div>
                                    </td>
                                    <td><div style="font-weight: bold"> PLAN TYPE : </div></td>
                                    <td>@if(starts_with($planType,"Monthly"))
                                            <div class="huge" style="font-weight: bolder; font-size: 20px;">Monthly</div>
                                        @else
                                            <div class="huge" style="font-weight: bolder; font-size: 20px;">Annual</div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><div style="font-weight: bold;"> JOINED ON : </div></td>
                                    <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $startDate->subDay()->format('m-d-Y')  }}</div></td>
                                </tr>
                                <td><div style="font-weight: bold;"> RENEWAL DATE : </div></td>
                                <td><div class="huge" style="font-weight: bolder; font-size: 20px">{{ $renewalDate->subDay()->format('m-d-Y') }}</div></td>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
            <div class="row">

                <!-- /.col-lg-8 -->
                <div class="col-lg-12">
                    <div class="panel panel-default text-left">
                        <div class="panel-heading">
                            <b>Business Donations</b>
                        </div>

                        <div class="panel-body">
                            @if(!is_null($organizations) && !empty($organizations))
                                <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr class="bg-info">
                                        <th class="text-center">Location Name</th>
                                        <th class="text-center">Location Address</th>
                                        <th class="text-center">Approved</th>
                                        <th class="text-center">Rejected</th>
                                        <th class="text-center">Amount Approved</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody style="text-align: center">
                                        @foreach($organizations as $organization)
                                            <tr>
                                                <td style="vertical-align: middle">{{ $organization->org_name }}</td>
                                                <td style="vertical-align: middle"><?php echo ($organization->street_address1 . ' ' . $organization->street_address2 . ' ' . $organization->city . ' ' . $organization->state . ' ' . $organization->zipcode); ?></td>
                                                <td style="vertical-align: middle">{{ App\Organization::find($organization->id)->approvedDonationRequest->where('approval_status_id', \App\Custom\Constant::APPROVED)->count() }}</td>
                                                <td style="vertical-align: middle">{{ App\Organization::find($organization->id)->approvedDonationRequest->where('approval_status_id', \App\Custom\Constant::REJECTED)->count() }}</td>
                                                <td style="vertical-align: middle">${{ number_format(App\Organization::find($organization->id)->approvedDonationRequest->where('approval_status_id', \App\Custom\Constant::APPROVED)->where('updated_at', '>', \Carbon\Carbon::now()->startOfYear())->sum('approved_dollar_amount'), 2)  }} </td>
                                                <td style="vertical-align: middle"> {{ $organization->is_active }}</td>
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

        <div class="col-md-12 text-center">
            <input class="btn btn-info backbtn" type="button" value="Back" onClick="history.go(-1);">
        </div>

        <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    </div>
@endsection