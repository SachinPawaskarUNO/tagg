@extends('layouts.app')
@section('content')
    <br>
    <div class="container">
        <div class="row">
                
                <div class="panel panel-default">
                     <div class="panel-heading"><h1  style="font-size:22px";>Donation Request Detail</h1></div>

                    <table class="table table-striped table-bordered table-hover">
                        <div>

                            <tbody>
                            <tr class="bg-info">
                            <tr>
                                <td>Name of Organization</td>
                                <td><?php echo ($donationrequest['requester']); ?></td>
                            </tr>
                            <tr>
                                <td>Type of Organization</td>
                                <td><?php echo ($donationRequestName); ?></td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td><?php echo ($donationrequest['first_name']); ?> <?php echo ($donationrequest['last_name']); ?></td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td><?php echo ($donationrequest['email']); ?></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td><?php echo ($donationrequest['phone_number']); ?></td>
                            </tr>
                            <tr>
                                <td>Address 1</td>
                                <td><?php echo ($donationrequest['street_address1']); ?></td>
                            </tr>
                            <tr>
                                <td>Address 2</td>
                                <td><?php echo ($donationrequest['street_address2']); ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?php echo ($donationrequest['city']); ?></td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td><?php echo ($donationrequest['state']); ?></td>
                            </tr>
                            <tr>
                                <td>Zip Code</td>
                                <td><?php echo ($donationrequest['zipcode']); ?></td>
                            </tr>

                            <tr>
                                <td>Tax Exempt</td>
                                <td>
                                    <?php $taxexempt_value=" ";
                                    if($donationrequest['tax_exempt']==1){
                                        $taxexempt_value="Yes";}
                                    else {
                                        $taxexempt_value="No";
                                    }
                                    ?><?php echo ($taxexempt_value); ?>
                                </td>
                            </tr>
                            <?php  if($donationrequest['tax_exempt'] == 1) { ?>
                            <tr>
                                <td>File URL</td>
                                <!-- <td> echo ($file_url)</td> -->
                                <td><a href="<?php echo($donationrequest['file_url']) ?>" target="_blank"><b>Link to
                                            File</b> </a></td>

                            </tr>
                            <?php } else { ?>



                        <?php } ?>

                            <tr>
                                <td>Request For</td>
                                <td><?php echo ($item_requested_name); ?></td>
                            </tr>
                            <?php  if($donationrequest['item_requested'] == 5) { ?>
                            <tr>
                                <td>Requested Item Explained:</td>
                                <!-- <td> echo ($file_url)</td> -->
                                <td><?php echo($donationrequest['other_item_requested']) ?></td>


                            <?php } else { ?>

                            <td>Requested Item Explained:</td>
                            <!-- <td> echo ($file_url)</td> -->
                            <td><?php echo "Not Applicable" ?></td>
                            </tr>
                        <?php } ?>

                            <tr>
                                <td>Requested Dollar Amount</td>
                                <td>$<?php echo (number_format($donationrequest['dollar_amount'])); ?></td>
                            </tr>
                            <tr>
                                <td>Donation Purpose</td>
                                <td><?php echo ($donation_purpose_name); ?></td>
                            </tr>
                            <?php  if($donationrequest['item_purpose'] == 9) { ?>
                            <tr>
                                <td>Donation Purpose Explained:</td>
                                <!-- <td> echo ($file_url)</td> -->
                                <td><?php echo($donationrequest['other_item_purpose']) ?></td>


                            <?php } else { ?>

                            <td>Requested Item Explained:</td>
                            <!-- <td> echo ($file_url)</td> -->
                            <td><?php echo "Not Applicable" ?></td>

                            <?php } ?>
                            </tr>
                            <tr>
                                <td>Handout Date</td>
                                <td><?php echo date("m/d/Y", strtotime($donationrequest['needed_by_date'])); ?></td>
                            </tr>
                            <tr>
                                <td>Event Name</td>
                                <td><?php echo ($donationrequest['event_name']); ?></td>
                            </tr>
                            @if($donationrequest->event_start_date)
                                <tr>
                                    <td>Event Date</td>
                                    <td><?php echo date("m/d/Y", strtotime($donationrequest['event_start_date'])); ?></td>
                                </tr>
                            @endif
                            @if($donationrequest->event_type)
                                <tr>
                                    <td>Event Purpose</td>
                                    <td><?php echo ($event_purpose_name); ?></td>
                                </tr>
                            @endif
                            @if($donationrequest->est_attendee_count)
                                <tr>
                                    <td>Estimated Number of Attendes</td>
                                    <td><?php echo (number_format($donationrequest['est_attendee_count'])); ?></td>
                                </tr>
                            @endif
                            <tr>
                                <td>Event Venue or Address</td>
                                <td><?php echo ($donationrequest['venue']); ?></td>
                            </tr>
                            <tr>
                                <td>What are the marketing opportunities?</td>
                                <td><?php echo ($donationrequest['marketing_opportunities']); ?></td>
                            </tr>
                            @if($donationrequest->approval_status_id == \App\Custom\Constant::APPROVED OR $donationrequest->approval_status_id == \App\Custom\Constant::REJECTED)
                                <tr>
                                    <td>Approved Amount</td>
                                    <td>$<?php echo ($donationrequest['approved_dollar_amount']); ?></td>
                                </tr>
                            @endif
                            </tbody>
                        </div>
                    </table>
                </div>
                @if($donationAcceptanceFlag == 1)
                    {!! Form::open(['method'=> 'POST', 'action' => 'DonationRequestController@changeDonationStatus']) !!}
                        {{ csrf_field() }}
                    {!! Form::hidden('fromPage','detailspage',['class'=>'form-control', 'readonly']) !!}
                        @if ($donationrequest->approval_status_id == \App\Custom\Constant::SUBMITTED OR $donationrequest->approval_status_id == \App\Custom\Constant::PENDING_REJECTION OR $donationrequest->approval_status_id == \App\Custom\Constant::PENDING_APPROVAL)
                            @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                <div>
                                    <label for="dollar_amount" class="col-md-3 control-label">Dollar Amount Approval</label>
                                    <div class="col-lg-6">

                                        {!! Form::hidden('id',$donationrequest->id,['class'=>'form-control', 'readonly']) !!}
                                        {!! Form::text('approved_amount',round($donationrequest->dollar_amount), ['id' => 'approved_amount', 'class' => 'form-control', 'min'=>'0', 'step'=>'1', 'required'] )!!}
                                    </div>
                                </div>
                                <br><br>
                            @endif
                        @endif
                        <div style="text-align:center">

                            @if ($donationrequest->approval_status_id == \App\Custom\Constant::SUBMITTED OR $donationrequest->approval_status_id == \App\Custom\Constant::PENDING_REJECTION OR $donationrequest->approval_status_id == \App\Custom\Constant::PENDING_APPROVAL)
                                @if(Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_ADMIN OR Auth::user()->roles[0]->id == \App\Custom\Constant::BUSINESS_USER)
                                 <div class="row">
                                  <div class="col-md-6">
                                    {!! Form::submit( 'Approve & customize response', ['class' => 'btn btn-success', 'style' => 'background-color: #18B1C1;', 'name' => 'submitbutton', 'value' => 'approve'])!!}
                                    {!! Form::submit( 'Approve & send default email', ['class' => 'btn btn-success',  'style' => 'background-color: #18B1C1;','name' => 'submitbutton', 'value' => 'approvedef'])!!}
                                  </div>
                                  <div class="col-md-6">
                                    {!! Form::submit( 'Reject & customize response', ['class' => 'btn backbtnsubs', 'name' => 'submitbutton', 'value' => 'reject']) !!}
                                    {!! Form::submit( 'Reject & send default email', ['class' => 'btn backbtnsubs', 'name' => 'submitbutton', 'value' => 'rejectdef']) !!}
                                  </div>
                                  </div>
                                @endif

                                <input id = 'cancel' class="btn backbtn" type="button" value="Cancel" onClick="history.go(-1);">
                                {{--<a href="{{ route('donationrequests.index')}} " class="btn btn-basic">Return to Donation--}}
                                {{--Request</a>--}}
                            @else
                                <input id = 'cancel1' class="btn backbtn" type="button" value="Cancel" onClick="history.go(-1);">
                            @endif
                        </div>
                    {!! Form::close() !!}
                @endif
                <br><br>
            </div>
        </div>
    </div>
 
@stop
