@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="text-align: left;font-weight: bold;">There are two ways to utilize your CharityQ  Donation Form.</h1></div>
                    <div class="panel-body">
                        <script type="text/javascript">
                            function Copy() {
                                var urlCopied = document.getElementById('urlCopied');
                                urlCopied.value = "{{url('donationrequests/create')}}?orgId={{encrypt($organization->id)}}&newrequest=true" ;
                                urlCopied.select();
                                //Copied = Url.createTextRange();
                                document.execCommand("copy");
                            }
                            function GenerateDRForm() {
                                var embedCode = document.getElementById('embeddedCode');
                                embedCode.value = '<iframe src="{{url('donationrequests/create')}}?orgId={{encrypt($organization->id)}}&newrequest=true"\n style="border:none;" id="donationRequest1" name="ifr" frameBorder="0" height="800" width="800" > \n</iframe>';
                                embedCode.select();
                                document.execCommand("copy");
                            }

                        </script>
                        <div>
                            <input id = 'create_URL' type="button" class="btn btn-info"
                                    style="cursor: help;background-color: #0099CC;" value="Create URL"
                                    title="For use for promotions or on social media." onclick="Copy();"/><br />
                            <small>
                                This will provide you with a website link to your donation form.
                            </small><br />
                            <input type="text"  id="urlCopied" size="80"/><br />

                            <input id = 'createForm' type="button" class="btn btn-info"
                                    style="cursor: help;background-color: #0099CC;" value="Create Embedded Form Code"
                                    title="Insert this HTML code in your business website to allow outside organizations to fill out a donation request form.."
                                    onclick="GenerateDRForm();" /><br />
                            <small>This provides you with code to copy onto your website (into an iframe).</small><br />
                            <textarea type="textarea"
                                        style="width:680px; height: 70px"  id="embeddedCode" size="80"></textarea><br />
                        </div>
                    </div>

                    </div>

            </div>
            <div class="form-group">
                <center>
                <div class="text-center">
                    <button id="SetDonationPref" class="btn savebtn" style="background-color: #0099CC;"
                            type="button" onClick = location.href='{{ url('/rules?rule=1')}}';>Set Donation Preferences
                        </button>
                    <input id = 'cancel' class="btn backbtn" type="button" value="Cancel" onClick=location.href='{{ url('/dashboard')}}'>
                    </div>
                </center>
        </div>
    </div>
</div>

