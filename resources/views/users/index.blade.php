@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1> View & Update Profile </h1></div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Phone Number</th>
                                <th colspan="3" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td style="vertical-align: middle">{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td style="vertical-align: middle">{{ $user->email }}</td>
                                    <td style="vertical-align: middle">{{ $user->street_address1 }} {{ $user->street_address2 }}, {{ $user->city }}, {{ $user->state }} {{ $user->zipcode }}</td>
                                    <td style="vertical-align: middle">{{ $user->phone_number }}</td>
                                    <td style="vertical-align: middle"><a href="{{route('users.edit',$user->id)}}" class="btn btn-warning"> Edit </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="panel-heading"><h1>Add a User</h1></div>
                        <td><a href="{{route('users.show',$user->id)}}" class="btn btn-warning"> Create Account </a>

                            <div class="panel-heading"><h1>Generate URL for Donations</h1></div>



                            <script type="text/javascript">
                                function Copy() {
                                    var Url = document.createElement("textarea");
                                    var orgId = "{{Auth::user()->organization_id}}";

                                    urlCopied.innerHTML = "http://tagg-preprod.herokuapp.com/donationrequests/create?orgId={{Auth::user()->organization_id}}" ;
                                    //Copied = Url.createTextRange();
                                    //Copied.execCommand("Copy");
                                    window.confirm("You have successfully generated the URL needed for donation Requests on your website")
                                    var txt;

                                }
                            </script>
                            <body>
                            <div>

                                <input type="button" value="Copy Url" onclick="Copy();" />
                                <br />

                                Paste: <textarea id="urlCopied" rows="1" cols="75"></textarea>

                            </div>






                            </body>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection