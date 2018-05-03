@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Security Questions Setup - {{ $user->first_name }} {{$user->last_name}}</div>
                    <div class="panel-body">

                        {{--<form method="POST" action="{{ action('UserSecurityQuestionController@store') }}">--}}
                        {!! Form::open(['action' =>  'UserSecurityQuestionController@store', 'method' => 'post' ]) !!}
                        {!! Form::hidden('user_id',$user->id,['class'=>'form-control', 'readonly']) !!}
                        <div class="form-group{{ $errors->has('securityquestion') ? ' has-error' : '' }}">
                            <label for="question_id" class="control-label">First Security Question <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="">
                                {!! Form::select('question_id', array(null => 'Select...') + $securityquestions->all(), null, ['class'=>'form-control']) !!}
                                @if ($errors->has('question_id'))

                                    <span class="help-block">
                                        <strong>{{ $errors->first('question_id') }}</strong>
                                    </span>

                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                            <label for="answer" class="control-label">First Answer <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="">
                                <input id="answer" type="text" class="form-control" name="answer" value="{{ old('answer') }}" placeholder="Your First Answer" autocomplete="off" required autofocus>

                                @if ($errors->has('answer'))

                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>

                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('securityquestion') ? ' has-error' : '' }}">
                            <label for="securityquestion" class="control-label">Second Security Question <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="">
                                {!! Form::select('securityquestion', array(null => 'Select...') + $securityquestions->all(), null, ['class'=>'form-control']) !!}
                                @if ($errors->has('securityquestion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('securityquestion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                            <label for="answer" class="control-label">Second Answer <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="">
                                <input id="answer" type="text" class="form-control" name="answer2" value="{{ old('answer') }}" placeholder="Your Second Answer" autocomplete="off" required autofocus>

                                @if ($errors->has('answer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('securityquestion') ? ' has-error' : '' }}">
                            <label for="securityquestion" class="control-label">Third Security Question <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>

                            <div class="">
                                {!! Form::select('securityquestion', array(null => 'Select...') + $securityquestions->all(), null, ['class'=>'form-control']) !!}
                                @if ($errors->has('securityquestion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('securityquestion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                            <label for="answer3" class="control-label">Third Answer <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="">
                                <input id="answer" type="text" class="form-control" name="answer" value="{{ old('answer') }}" placeholder="Your Third Answer" autocomplete="off" required autofocus>

                                @if ($errors->has('answer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-4 col-md-offset-4">
                            {!! Form::submit('Save', ['class' => 'btn btn-basic form-control']) !!}
                        </div>
                        {!! Form::hidden('_token', csrf_token()) !!}
                        {!! Form::close() !!}
                        {{--</form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop