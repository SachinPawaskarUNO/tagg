@extends('app')
@section('content')
    <h1>Create Security Question</h1>
    {!! Form::open(['url' => 'securityquestions']) !!}

    <div class="form-group">
        {{--{!! Form::label('UserID', 'User ID:') !!}--}}
        {!! Form::hidden('user_id',$users,['class'=>'form-control', 'readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::select('question', array(
            'What was your childhood nickname?' => 'What was your childhood nickname?',
            'In what city or town did your mother and father meet?' => 'In what city or town did your mother and father meet?',
            'What is your favorite team?' => 'What is your favorite team?',
            'What was your favorite sport in high school?' => 'What was your favorite sport in high school?'),
             null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop