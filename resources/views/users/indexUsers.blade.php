@extends('layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Users</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="container">
        @if(Session::has('flash_message'))
            <div class="col-md-8 alert alert-success">
                {{Session::get('flash_message')}}
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: left;font-weight: bold;"> Active Users </h1>
                        <a href="{{route('users.show', encrypt($admin->id))}}" class="btn savebtn"
                           style="position: absolute; top: 26px; right:32px;background-color: #0099CC;">[+] Add
                            User </a>
                    </div>

                    <div class="panel-body">

                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">Business User</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Business Location</th>
                               <!-- <th class="text-center">City & Zip Code</th> -->
                                <th colspan="3" class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr class="text-center">
                                <td style="vertical-align: middle">{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td style="vertical-align: middle">{{ $user->roles[0]->name }}</td>
                                <td style="vertical-align: middle">{{ $user->organization->org_name }}</td>

                               <!-- <td style="vertical-align: middle">{{ $user->organization->city }}, {{ $user->organization->zipcode }}</td>  -->

                                <td style="vertical-align: middle"><a href="{{route('edituser',$user->id)}}"



                                <td style="vertical-align: middle"><a href="{{route('edituser',encrypt($user->id))}}"

                                                                      class="btn savebtn"
                                                                      style="background-color: #0099CC;"> Edit </a>
                                </td>
                                <!--<td style="vertical-align: middle">
                                    <input type="submit" value="Delete" class='btn backbtn'
                                           onClick="return confirm('Are you sure you want to delete this user?');">
                                </td>
                            </tr> -->
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
