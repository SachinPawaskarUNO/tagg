@extends('layouts.app')

@section('content')

    <div id="wrapper">

        <!-- Navigation -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Request Management
                        Dashboard</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading" style="background-color: #56ba94 ;">
                            <div class="row">
                                <div class="col-xs-3" style="padding-bottom: 15px;">
                                    <i class="fa fa-money fa-5x" style="color: white"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge" style="color: white;font-size: 35px;font-weight: bolder;">
                                        ${{number_format($amountDonated, 2)}}</div>
                                    <div style="color: white;font-size: 15px;font-weight: bolder;">TOTAL AMOUNT
                                        DONATED
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading" style="background-color: #9f8cb9;">
                            <div class="row">
                                <div class="col-xs-3" style="padding-bottom: 15px;">
                                    <i class="fa fa-check-square-o fa-5x" style="color: white"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"
                                         style="color: white;font-size: 35px;font-weight: bolder;">{{number_format($approvedNumber)}}</div>
                                    <div style="color: white;font-size: 15px;font-weight: bolder;">REQUESTS APPROVED</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading" style="background-color: #6c6ba4;">
                            <div class="row">
                                <div class="col-xs-3" style="padding-bottom: 15px;">
                                    <i class="fa fa-clock-o fa-5x" style="color: white;"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"
                                         style="color: white;font-size: 35px;font-weight: bolder;">{{number_format($pendingNumber)}}</div>
                                    <div style="color: white;font-size: 15px;font-weight: bolder;">REQUESTS PENDING</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading" style="background-color: #332f52;">
                            <div class="row">
                                <div class="col-xs-3" style="padding-bottom: 15px;">
                                    <i class="fa fa-window-close-o fa-5x" style="color: white"></i>
                                </div>
                                <div class="col-xs-9 text-left">
                                    <div class="huge"
                                         style="color: white;font-size: 35px;font-weight: bolder;">{{number_format($rejectedNumber)}}</div>
                                    <div style="color: white;font-size: 15px;font-weight: bolder;">REQUESTS REJECTED</div>
                                </div>
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
                            <b>Pending Requests</b>
                        </div>

                        <!-- Donation request -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            @if(sizeOf($donationrequests) != 0)
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" style=>
                                    <thead>
                                    <tr class="bg-info">
                                        <th class="text-center">Select all <input type="checkbox" id="selectall"/></th>
                                        <th class="text-center">Organization Name</th>
                                        <th class="text-center">Request Amount</th>
                                        <th class="text-center">Type of Donation</th>
                                        <th class="text-center">Location</th>
                                        <th class="text-center">Date Needed</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Status Reason</th>
                                        <th class="text-center">View Details</th>
                                    </tr>
                                    </thead>

                                    <tbody  style="text-align: center">
                                        @foreach ($donationrequests as $donationrequest)
                                            <tr>
                                                <td style="vertical-align: middle"><input type="checkbox" class="myCheckbox" ids="{{$donationrequest->id}}"/></td>
                                                <td style="vertical-align: middle">{{ $donationrequest->requester }}</td>
                                                <td style="vertical-align: middle">${{ number_format($donationrequest->dollar_amount, 2) }}</td>
                                                <td style="vertical-align: middle">{{ $donationrequest->donationRequestType->item_name }}</td>
                                                <td style="vertical-align: middle">{{$donationrequest->organization->org_name }}</td>
                                                <td style="vertical-align: middle"><?php echo date("m/d/Y", strtotime($donationrequest->needed_by_date)); ?></td>

                                                <td id="status{{$donationrequest->id}}" style="vertical-align: middle">{{ $donationrequest->donationApprovalStatus->status_name }}</td>
                                                <td style="vertical-align: middle" id="status{{$donationrequest->id}}">{{ $donationrequest->approval_status_reason }}</td>
                                                <td>
                                                    <a href="{{route('donationrequests.show',encrypt($donationrequest->id))}}" class="btn btn-info" title="Detail">
                                                        <span class="glyphicon glyphicon-list-alt" text-></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            @else
                                <div>No pending donation requests to show.</div>
                            @endif
                                </table>
                                {!! Form::open(['action' =>  'EmailTemplateController@send', 'method' => 'GET']) !!}
                                {{ csrf_field() }}
                                {{ Form::hidden('ids_string','' , array('id' => 'selected-ids-hidden')) }}
                                {{ Form::hidden('page_from', '/dashboard') }}
                                {{--add if condition to show approve and reject buttons only if there are pending requests and atleast one is selected--}}
                                @if(sizeOf($donationrequests) != 0)
                                  <div class="col-md-6 col-md-offset-5">
                                    {!! Form::submit( 'Approve', ['class' => 'btn btn-success', 'name' => 'submitbutton', 'value' => 'approve'])!!}
                                    {!! Form::submit( 'Reject', ['class' => 'btn btn-danger', 'name' => 'submitbutton', 'value' => 'reject']) !!}
                                  </div>
                                @endif
                                {!! Form::close() !!}
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
                $('#example').DataTable();
                // Storing the number of all the checkboxes
                // of donation requests
                var totalCheckboxes = $('.myCheckbox').length;
                // Toggling selectall by checking if all the checkboxes are checked
                $('.myCheckbox').change(function() {
                    if (($('.myCheckbox:checked').size() == totalCheckboxes) && (totalCheckboxes != 0)) {
                        $('#selectall').prop('checked', true);
                    } else {
                        $('#selectall').prop('checked', false);
                    }
                });
            } );

            $('#selectall').change(function() {
                idsArray = [];
                if(document.getElementById('selectall').checked) {
                    $('.myCheckbox').prop('checked', true);
                    $('.myCheckbox').each(function(){
                        idsArray.push($(this).attr('ids'));
                    });
                    $('#selected-ids-hidden').val(idsArray);
                    //get all ids push to idsArray
                } else {
                    $('.myCheckbox').prop('checked', false);

                    $('#selected-ids-hidden').val('');
                    // empty/splice idsArray
                }

            });

            var idsArray = [];

            // Populating array with the list of checkboxes with
            // checked ids
            $('.myCheckbox').change(function () {
                var id = $(this).attr('ids');
                if(this.checked) {
                    idsArray.push(id);
                } else {
                    idsArray.splice(idsArray.indexOf(id), 1);
                }
                $('#selected-ids-hidden').val((idsArray));
            });

            // This function uses Ajax call.
//            function func(actionStatus) {
//
//
//                $('#selected-ids-hidden').val(JSON.stringify(idsArray));
//
//                // Populating array with the list of checkboxes with
//                // checked ids
//                $('.myCheckbox').each(function () {
//                    if(this.checked) {
//                        idsArray.push($(this).attr('ids'));
//                    }
//                });
//
//                // Sending an ajax post request with the list of checked
//                // checkboxes to update to either approved or rejected
//                $.ajax({
//                    type: "POST",
//                    url: 'donation/change-status',
//                    dataType: 'json',
//                    headers: {
//                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                    },
//                    success: function( resp ) {
//                        //window.location.href = 'emaileditor/editsendmail/' + $.param(idsArray);
//                        setStatusText = '';
//                        if(resp.status == 0) {
//                            setStatusText = 'Approved';
//                        } else if (resp.status == 1) {
//                            setStatusText = 'Rejected';
//                        }
//                        // Handle your response..
//                        for (var i = 0; i < resp.idsArray.length; i++) {
//                            // 0 - approved
//                            //1- rejected
//                            $('#status' + resp.idsArray[i]).text(setStatusText);
//                        }
//                        //alert(resp.emailids);
//                    },
//                    data: {ids:idsArray, status:actionStatus}
//                });
//
//                // clearing the array
//                idsArray = [];
//
//                $('input:checkbox:checked').prop('checked', false);
//
//            }
        </script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    </div>
@endsection
