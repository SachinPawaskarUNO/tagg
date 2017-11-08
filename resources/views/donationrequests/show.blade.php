@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Donation Request Detail</div>

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
                            <?php $taxexempt_value=" ";
                             if($donationrequest['tax_exempt']==1){
                             $taxexempt_value="Yes";}
                             else {
                               $taxexempt_value="No";
                             } 
                             ?>

                            <tr>
                                <td>Tax Exempt</td>
                                <td><?php echo "$taxexempt_value" ; ?></td>
                            </tr>
                            <tr>
                                <td>Request For</td>
                                <td><?php echo ($item_requested_name); ?></td>
                            </tr>
                            <tr>
                                <td>Dollar Amount</td>
                                <td>$<?php echo ($donationrequest['dollar_amount']); ?></td>
                            </tr>
                            <tr>
                                <td>Donation Purpose</td>
                                <td><?php echo ($donation_purpose_name); ?></td>
                            </tr>
                            <tr>
                                <td>Handout Date</td>
                                <td><?php echo date("m/d/Y", strtotime($donationrequest['needed_by_date'])); ?></td>
                            </tr>
                            <tr>
                                <td>Event Name</td>
                                <td><?php echo ($donationrequest['event_name']); ?></td>
                            </tr>
                            <tr>
                                <td>Event Start Date</td>
                                <td><?php echo date("m/d/Y", strtotime($donationrequest['event_start_date'])); ?></td>
                            </tr>
                            <tr>
                                <td>Event End Date</td>
                                <td><?php echo date("m/d/Y", strtotime($donationrequest['event_end_date'])); ?></td>
                            </tr>
                            <tr>
                                <td>Event Purpose</td>
                                <td><?php echo ($event_purpose_name); ?></td>
                            </tr>
                            <tr>
                                <td>Estimated Number Of Attendes</td>
                                <td><?php echo ($donationrequest['est_attendee_count']); ?></td>
                            </tr>
                            <tr>
                                <td>Event Venue or Address</td>
                                <td><?php echo ($donationrequest['venue']); ?></td>
                            </tr>
                            <tr>
                                <td>What are the marketing opportunities?</td>
                                <td><?php echo ($donationrequest['marketing_opportunities']); ?></td>
                            </tr>
                            @if($donationrequest->approved_dollar_amount <> 0.00)
                                <tr>
                                    <td>Approved Amount</td>
                                    <td>$<?php echo ($donationrequest['approved_dollar_amount']); ?></td>
                                </tr>
                            @endif
                            </tbody>
                        </div>
                    </table>
                </div>
                {!! Form::open(['method'=> 'POST', 'action' => 'DonationRequestController@changeDonationStatus']) !!}
                @if ($donationrequest->approval_status_id == 1 OR $donationrequest->approval_status_id == 2 OR $donationrequest->approval_status_id == 3)
                    <div>
                        <label for="dollar_amount" class="col-md-3 control-label">Dollar Amount Approval</label>
                        <div class="col-lg-6">
                            {!! Form::hidden('id',$donationrequest->id,['class'=>'form-control', 'readonly']) !!}
                            {!! Form::text('approved_amount', $donationrequest['dollar_amount'], ['class' => 'form-control', 'required'] )!!}
                        </div>
                    </div>
                    <br><br>
                @endif
                <div style="text-align:center">
                    @if ($donationrequest->approval_status_id == 1 OR $donationrequest->approval_status_id == 2 OR $donationrequest->approval_status_id == 3)
                        <input class="btn active btn-success" type="submit" name="approve" value="Approve">
                        <input class="btn active btn-danger" type="submit" name="reject" value="Reject">
                        <a href="{{ route('donationrequests.index')}} " class="btn btn-primary">Return to Donation
                            Request</a>
                    @else
                        <a href="{{ route('donationrequests.index')}} " class="btn btn-primary">Return to Donation
                            Request</a>
                    @endif
                </div>
                {!! Form::close() !!}


                <br><br>
            </div>
                </div>
            </div>
        </div>
    </div>
@stop
