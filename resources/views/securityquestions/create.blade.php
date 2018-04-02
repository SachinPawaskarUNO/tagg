@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Security Questions Setup</div>
                    <div class="panel-body">
                            {!! Form::open(['action' =>  'UserSecurityQuestionController@store', 'method' => 'post' ]) !!}
                        {!! Form::hidden('user_id',$user,['class'=>'form-control', 'readonly']) !!}

                        <div class="form-group{{ $errors->has('question_id[]') ? ' has-error' : '' }}">
                            <label for="question_id[]" class="control-label">First Security Question </label>

                            <div class="form-group{{ $errors->has('question_id[]') ? ' has-error' : '' }}">
                                {!! Form::select('question_id[]', array(null => 'Select...') + $question_list1->all(), null, ['class'=>'form-control']) !!}
                                @if ($errors->has('question_id[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question_id[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer[]') ? ' has-error' : '' }}">
                            <label for="answer[]" class="control-label">First Answer </label>
                            <div class="">
                                <input id="answer[]" type="text" class="form-control" name="answer[]" value="{{ old('answer[]') }}" placeholder="Your First Answer" autocomplete="off" required autofocus>
                                @if ($errors->has('answer[]'))

                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer[]') }}</strong>
                                    </span>

                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('question_id[]') ? ' has-error' : '' }}">
                            <label for="question_id[]" class="control-label">Second Security Question </label>

                            <div class="">
                                {!! Form::select('question_id[]', array(null => 'Select...') + $question_list2->all(), null, ['class'=>'form-control']) !!}
                                @if ($errors->has('question_id[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question_id[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer[]') ? ' has-error' : '' }}">
                            <label for="answer[]" class="control-label">Second Answer </label>
                            <div class="">
                                <input id="answer[]" type="text" class="form-control" name="answer[]" value="{{ old('answer[]') }}" placeholder="Your Second Answer" autocomplete="off" required autofocus>

                                @if ($errors->has('answer[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('question_id[]') ? ' has-error' : '' }}">
                            <label for="question_id[]" class="control-label">Third Security Question </label>

                            <div class="">
                                {!! Form::select('question_id[]', array(null => 'Select...') + $question_list3->all(), null, ['class'=>'form-control']) !!}
                                @if ($errors->has('question_id[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question_id[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('answer[]') ? ' has-error' : '' }}">
                            <label for="answer[]" class="control-label">Third Answer </label>
                            <div class="">
                                <input id="answer[]" type="text" class="form-control" name="answer[]" value="{{ old('answer[]') }}" placeholder="Your Third Answer" autocomplete="off" required autofocus>

                                @if ($errors->has('answer[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('answer[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group col-md-4 col-md-offset-4">
                            {!! Form::submit('Save', ['class' => 'btn btn-basic form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                        {{--</form>--}}
                    </div>
            </div>
        </div>
    </div>
</div>
@stop