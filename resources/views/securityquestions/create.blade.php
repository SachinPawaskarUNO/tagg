@extends('app')
@section('content')
    <h1>Create Security Question</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['url' => 'securityquestions']) !!}

    <div class="form-group">
        {{--{!! Form::label('UserID', 'User ID:') !!}--}}
        {!! Form::hidden('user_id',$users,['class'=>'form-control', 'readonly']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::select('question1', array(
            'What was your childhood nickname?' => 'What was your childhood nickname?',
            'In what city or town did your mother and father meet?' => 'In what city or town did your mother and father meet?',
            'What is your favorite team?' => 'What is your favorite team?',
            'What was your favorite sport in high school?' => 'What was your favorite sport in high school?'),
             null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer1',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::select('question2', array(
            'In what city or town does your nearest sibling live?' => 'In what city or town does your nearest sibling live?',
            'What is your pet’s name?' => 'What is your pet’s name?',
            'In what year was your father born?' => 'In what year was your father born?',
            'What was the last name of your third grade teacher?' => 'What was the last name of your third grade teacher?'),
             null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer2',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Question', 'Question:') !!}
        {!! Form::select('question3', array(
            'What is the first name of the boy or girl that you first kissed?' => 'What is the first name of the boy or girl that you first kissed?',
            'What was the name of your elementary school?' => 'What was the name of your elementary school?',
            'What was the house number and street name you lived in as a child?' => 'What was the house number and street name you lived in as a child?',
            'In what town or city was your first full time job?' => 'In what town or city was your first full time job?'),
             null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Answer', 'Answer:') !!}
        {!! Form::text('answer3',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close() !!}
@stop
