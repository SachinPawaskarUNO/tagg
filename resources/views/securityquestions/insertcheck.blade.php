@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Answer Security Questions</div>
                        {!! Form::model($user_securityquestion, ['method' => 'GET','action'=>['UserSecurityQuestionController@check', $user_securityquestion->question_id, $email_address]]) !!}

                    <div class="panel-body">
                        <div class="form-group">
                                <label for="question" class="control-label">Security Question</label>

                            {!! Form::hidden('question_id', null, ['class'=>'form-control readonly']) !!}

                            {!! Form::hidden('email_address', $email_address, ['class'=>'form-control readonly']) !!}

                            {{--{!! Form::label('Question', 'Question:', ['class'=>'control-label']) !!}--}}
                                <div class="form-control"><?php echo ($question_name); ?></div>
                            {{--{!! Form::text('question_name', null,['class'=>'form-control','readonly']) !!}--}}
                        </div>

                            <div class="form-group">
                            {!! Form::label('Answer', 'Answer:') !!}
                            {!! Form::text('answer_by_user',null,['class'=>'form-control', 'autocomplete'=>'off']) !!}
                            </div>

                            <h4 style="color:red">
                            {!! session()->get('error') !!}
                            </h4>

                            <br>

                            <div class="form-group col-md-4 col-md-offset-4">
                                {!! Form::submit('Check Answer', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop