@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard for {{ $organization->org_name }}</div>

                    <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr class="bg-info">
                                <th class="text-center">Location Name</th>
                                <th class="text-center">Location Address</th>
                                <th class="text-center">Location Requested Date</th>
                                <th class="text-center">Details</th>
                            </tr>
                        </thead>
                            <tbody style="text-align: center">
                            @foreach($organization->donationRequest as $donationRequest)
                                <tr>
                                    <td style="vertical-align: middle"><?php echo ($donationRequest->organization->org_name); ?></td>
                                    <td style="vertical-align: middle"><?php echo ($donationRequest['street_address1'] . ' ' . $donationRequest['street_address2'] . ' ' . $donationRequest['city'] . ' ' . $donationRequest['state'] . ' ' . $donationRequest['zipcode']); ?></td>
                                    <td style="vertical-align: middle"><?php echo ($donationRequest->created_at); ?></td>
                                    <td style="vertical-align: middle">
                                        <a href="{{route('donationrequests.show',encrypt($donationRequest->id))}}" class="btn btn-info" title="Detail">
                                            <span class="glyphicon glyphicon-list-alt"></span></a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable(
                {
                    responsive: true
                } 
            );
        });
    </script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@stop