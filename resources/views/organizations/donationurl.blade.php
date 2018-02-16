@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="col-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="text-align: left;font-weight: bold;">URL for Donations</h1></div>
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
                            <input type="button" class="btn btn-info"
                                    style="cursor: help;background-color: #0099CC;" value="Create URL"
                                    title="For use for promotions or on social media." onclick="Copy();"/>
                            <input type="text" placeholder="Click the button to display the URL and copy it to your clipboard" id="urlCopied" size="80"/><br />
                            <small>
                                Click the button to display the URL and copy it to your clipboard. Share your
                                business’ donation request form on social media sites.  The URL can be embedded on
                                your business website.  Outside organizations can submit requests online that will
                                automatically be filtered by your donation preferences.
                            </small><br />
                            <input type="button" class="btn btn-info"
                                    style="cursor: help;background-color: #0099CC;" value="Create Embedded Form Code"
                                    title="Insert this HTML code in your business website to allow outside organizations to fill out a donation request form.."
                                    onclick="GenerateDRForm();" /><br />
                            <textarea type="textarea"
                                        style="width:680px; height: 70px"  placeholder="Click the button to display the embed code and copy it to your clipboard" id="embeddedCode" size="80"></textarea><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<center>
        <a href="{{ url('/rules?rule=1')}}" title="Set Donation Preferences" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Set preferences</a>
        <a href="{{ url('/dashboard')}}" title="Navigate to Dashboard" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Cancel</a>

</center>
