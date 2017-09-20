@extends('app')
@section('content')
    <h1>Check Security Questions</h1>
    {!! Form::model($securityquestion,['method' => 'GET','action'=>['SecurityquestionController@check',$securityquestion->id]]) !!}
    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::text('question1',null,['class'=>'form-control','readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer1',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::text('Question2',null,['class'=>'form-control','readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer2',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::text('Question3',null,['class'=>'form-control','readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer3',null,['class'=>'form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop
