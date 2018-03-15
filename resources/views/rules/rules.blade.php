@extends('layouts.app')
@section('css')
    <!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://querybuilder.js.org/assets/css/docs.min.css" rel="stylesheet">
    <link href="http://querybuilder.js.org/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

@endsection
@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


@endsection
@section('content')

{{--  
<div class="container">
    <div class="row">
        <div class="col-md-6 col-center">  --}}
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><p class="lead"> Dontation Preferences </p>
                        <div class="">CharitQ allows you to optionally select criteria based on your donation preferences. Donation not meeting you selected
                                criterua or that would be ovebudget will be flagged as "pending rejecttion". to guide when reviewing requests.
                        </div>
                    </div>
                </div>
        <div class="panel-body">

        {!! Form::model($rule, ['action' => 'RuleEngineController@store']) !!}

        <div class="form-group">
        {!! Form::label('monthlyBudget', 'Budget $', ['class' => 'lead']) !!} 
        {!! Form::text('monthlyBudget', $monthlyBudget, ['class' => 'form-control col-xs-4' ]) !!}
        <div>By setting a monthly budget, any requests that come in after your budget is reached will be flagged as "Pending Rejection".</div>
        </div>
        

        <!-- Notice Days -->
        <div class="form-group">
        {!! Form::label('noticeDays', 'Notice', ['class' => 'lead']) !!}
        {!! Form::text('noticeDays', $daysNotice, ['class' => 'form-control']) !!}
        <div>By setting a number of days notice you need before the donation is due, any requests that do not meet or exceed the days notice required will be flagged as "Pending rejection- Not Enough Notice".</div>    
        </div>
        
        <!-- Organization Type -->
        <div class="form-group">
            {!! Form::label('orgType', 'Organization Type', ['class' => 'lead']) !!}
            @foreach ($rs as $r)
            {{--  {{ Form::label('orgTypeName', $r->type_name,array('id'=>'','class'=>'')) }}  --}}
            <div class="row">
                            {{ Form::checkbox('orgTypeId[]' , $r->id) }} {{$r->type_name}}
            </div>
            @endforeach
            <div>If organization types are selected, any donation requests from organization that fall in non-selected categories will be flagged as "Pending rejection - Org Type".</div>
        </div>
        

        <!-- Tax Exempt -->
        <div class="form-group">
                {!! Form::label('taxEx', 'Tax Exempt', ['class' => 'lead']) !!}
                <div class="row">{{ Form::radio('tax','1', true, ['checked' => 'checked']) }} Yes </div>
                        <div class="row"> {{ Form::radio('tax', '0', false, [])  }} No </div>
                <div>If checked, any donation requests from organizations without 501c status will be flagged as "Pending rejection- Not 501c3".</div>
        </div>
        

        <!-- Donation Type -->
        <div class="form-group">
                {!! Form::label('dtype', 'Donation Type', ['class' => 'lead']) !!}
                @foreach ($reqItemTypes as $reqItemType)
                {{--  {{ Form::label('dtypeName', $reqItemType->item_name,array('id'=>'','class'=>'')) }}  --}}
                <div class="row"> {{ Form::checkbox('dtypeId[]', $reqItemType->id ) }} {{$reqItemType->item_name}} </div>
                @endforeach 
                <div>By selecting the type(s) of donation requests you are willing to approve, any other requests will be flagged as "Pending Rejection - Donation type".</div>
        </div>
        

        <!-- Amount requested -->
        <div class="form-group">
                {!! Form::label('amtReq', 'Amount requested', ['class' => 'lead']) !!}
                {!! Form::text('amtReq', '', ['class' => 'form-control']) !!}
                <div>If an amount is entered, any request that exceed this dollar amount will be flagged as "Pending Rejection - Exceeded Amount".</div>
        </div>

        <button class="btn btn-success" type="submit">save</button>
        {!! Form::close() !!} 
    </div>
        </div>
    </div>
</div>

@endsection
