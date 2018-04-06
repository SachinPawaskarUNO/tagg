@extends('layouts.app')
<!-- Thanks to http://paulcracknell.com/9/create-a-change-password-page-laravel-5-3/ for the reset password code -->
@section ('css')
@endsection

@section('content')
    <div class="container" style="padding-top:2%">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 style="text-align: left;font-size:22px;">Change Password</h1>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{!! Session::get('success') !!}</div>
                        @endif
                        @if (Session::has('failure'))
                            <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
                        @endif
                        <form action="" method="post" role="form" class="form-horizontal">
                            {{csrf_field()}}

                            <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Old Password <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="password-old" type="password" class="form-control" name="old"
                                           placeholder="Enter Your Old Password">

                                    @if ($errors->has('old'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('old') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">New Password <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="password-new" type="password" class="form-control" name="password"
                                           placeholder="Enter Your New Password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" placeholder="Confirm Your New Password">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-3 col-md-offset-5">
                                    <button type="submit" class="btn btn-basic form-control">Submit</button>
                                </div><br><br>
                                  <div class="col-md-5 col-md-offset-5">
                                <span style="color: red"> <h5> Fields Marked With (*) Are Mandatory </h5></span>
                                  </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
