@extends('layouts.app')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Search Donations</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{--<div class="col-md-10 col-md-offset-1">--}}
            <div class="panel panel-default">
                <div class="panel-heading"><h1
                            style="text-align: left;font-weight: bold;">Business Name:&nbsp{{ $organizationName }}</h1>
                </div>
                <br>

                <div class="panel-body" style="position: relative;"><br><br>

                    @if(sizeOf($donationrequests) != 0)

                        <div class="dateControlBlock" style="position: absolute; top: 10px; right:16px; color: #111;">
                            <div style="">
                                From:&nbsp;&nbsp;&nbsp;<input type="date" name="dateStart" id="dateStart" size="8" style="box-shadow: 0 0 0.5px #333; width:140px"/>
                                &nbsp;To:&nbsp;&nbsp;&nbsp;<input type="date" name="dateEnd" id="dateEnd" size="8" style="box-shadow:0 0 0.5px #333; width:140px"/>
                            </div>
                        </div>


                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>

                            <tr class="bg-info">
                                <th class="text-center">Requester</th>
                                <th class="text-center">Organization Requester Type</th>
                                <th class="text-center">Requested Amount</th>
                                <th class="text-center">Type of Donation</th>
                                <th class="text-center">Donating Business</th>
                                <th class="text-center">Name of the Event</th>
                                <th class="text-center">Needed By Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Status Reason</th>
                                <th class="text-center">View Details</th>
                            </tr>
                            </thead>

                            <tfoot>

                            <tr class="bg-info">
                                <th class="text-center">Requester</th>
                                <th class="text-center">Organization Requester Type</th>
                                <th class="text-center">Requested Amount</th>
                                <th class="text-center">Type of Donation</th>
                                <th class="text-center">Donating Business</th>
                                <th class="text-center">Name of the Event</th>
                                <th class="text-center">Needed By Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Status Reason</th>
                                <th class="text-center">View Details</th>
                            </tr>
                            </tfoot>

                            <tbody style="text-align: center">
                            @foreach ($donationrequests as $donationrequest)
                                <tr>
                                    <td style="vertical-align: middle">{{ $donationrequest->requester }}</td>
                                    <td style="vertical-align: middle">{{ $donationrequest->donationRequestTypes->type_name }}</td>
                                    <td style="vertical-align: middle">${{ number_format($donationrequest->dollar_amount, 2) }}</td>
                                    <td style="vertical-align: middle">{{ $donationrequest->donationRequestType->item_name }}</td>
                                    <td style="vertical-align: middle">{{ $donationrequest->organization->org_name }}</td>
                                    <td style="vertical-align: middle">{{ $donationrequest->event_name }}</td>
                                    <td id="neededByDate"
                                        style="vertical-align: middle"><?php echo date("m/d/Y", strtotime($donationrequest->needed_by_date)); ?></td>

                                    <td style="vertical-align: middle"
                                        id="status{{$donationrequest->id}}">{{ $donationrequest->donationApprovalStatus->status_name }}</td>
                                    <td style="vertical-align: middle"
                                        id="status{{$donationrequest->id}}">{{ $donationrequest->approval_status_reason }}</td>
                                    <td style="white-space: nowrap">






                                            <a href="{{route('donationrequests.show',encrypt($donationrequest->id))}}"
                                               class="btn btn-info" title="Detail">
                                                <span class="glyphicon glyphicon-list-alt"></span></a>


                                    </td>
                                    {{--<td style="vertical-align: middle"><a href="{{route('donationrequests.show',$donationrequest->id)}}" class="btn savebtn"> Detail </a>--}}
                                    {{--                                    <td style="vertical-align: middle"><a href="{{route('donationrequests.edit',$donationrequest->id)}}" class="btn savebtn"> Edit </a>--}}
                                </tr>
                            @endforeach

                            </tbody>
                            @else
                                <div>No Donation Requests are in the system yet.</div>
                            @endif
                        </table>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css">

    <!--script src="https://code.jquery.com/jquery-1.12.4.js"></script-->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>

    <script src="{{ asset('js/range_dates.js') }}" type="text/javascript" data-date-column="6"></script>
    <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
    <script>
        webshims.setOptions('forms-ext', {types: 'date'});
        webshims.polyfill('forms forms-ext');
    </script>
    <script>

    // $('#example tfoot th').each( function () {
    //     var title = $(this).text();
    //     $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    // } );

    // // DataTable
    // var table = $('#example').DataTable();

    // // Apply the search
    // table.columns().every( function () {
    //     var that = this;

    //     $( 'input', this.footer() ).on( 'keyup change', function () {
    //         if ( that.search() !== this.value ) {
    //             that
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );

        $(document).ready(function () {



            $('#example tfoot th').each( function () {
                var title = $(this).text();
                $(this).html('<input type="text"  class="freetextsearch"  placeholder="Search ' + title + '" />');
            } );

            var table = $('#example').DataTable({
                dom: 'Bfrtip',

                scrollX : true,

                buttons: [
                    {
                        extend: 'pdf',
                        title: '{{ $organizationName }}',
                        filename: function () {
                            var d = new Date();
                            return '{{ $organizationName }}' + '{{$today}}';
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]  // indexes of the columns that should be printed,
                        }                      // Exclude indexes that you don't want to print.
                    },
                    {
                        extend: 'csv',
                        title: '{{ $organizationName }}',
                        filename: function () {
                            var d = new Date();
                            return '{{ $organizationName }}' + '{{$today}}';
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }

                    },
                    {
                        extend: 'excel',
                        title: '{{ $organizationName }}',
                        filename: function () {
                            var d = new Date();
                            return '{{ $organizationName }}' + '{{$today}}';
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                        }
                    }
                ]


            });
            // Add event listeners to the two range filtering inputs


//search
        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                    .column( colIdx )
                    .search( this.value )
                    .draw();
        } );

        $('#dateStart').change(function () {
            table.draw();
        });
        $('#dateEnd').change(function () {
            table.draw();
        });
    } );


        });

        function func(actionStatus, donId) {

            // Populating array with the id
            var idsArray = [donId];

            // Sending an ajax post request with the list of checked
            // checkboxes to update to either approved or rejected
            $.ajax({
                type: "POST",
                url: 'donation/change-status',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (resp) {
                    setStatusText = '';
                    if (resp.status == 0) {
                        setStatusText = 'Approved';
                    } else if (resp.status == 1) {
                        setStatusText = 'Rejected';
                    }
                    // Handle your response..
                    for (var i = 0; i < resp.idsArray.length; i++) {
                        // 0 - approved
                        //1- rejected
                        $('#status' + resp.idsArray[i]).text(setStatusText);
                    }
                },
                data: {ids: idsArray, status: actionStatus}
            });

            // clearing the array
            idsArray = [];


        }
    </script>
@endsection
