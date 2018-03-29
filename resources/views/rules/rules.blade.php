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
                    <div class="panel-heading"><p class="lead"> Donation Preferences</p>
                        <div class="">CharitQ allows you to optionally select criteria based on your donation preferences. Donation not meeting you selected
                            criteria or that would be overbudget will be flagged as "Pending rejection". to guide when reviewing requests.
                        </div>
                    </div>
                </div>
        <div class="panel-body">
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        {!! Form::model($ruleRow, ['action' => 'RuleEngineController@store']) !!}
        <div class="form-group">
        {!! Form::label('monthlyBudget', 'Budget $', ['class' => 'lead']) !!} 
        <div>
            By setting a monthly budget, any requests that come in after your budget is reached will be flagged as "Pending Rejection".
        </div>
        {!! Form::text('monthlyBudget', $monthlyBudget, ['id' => 'monthlyBudget','class' => 'form-control col-xs-4' ]) !!}
        </div>
        <!-- Notice Days -->
        <div class="form-group">
        {!! Form::label('noticeDays', 'Notice', ['class' => 'lead']) !!}
        <div>By setting a number of days notice you need before the donation is due, any requests that do not meet or exceed the days notice required will be flagged as "Pending rejection - Not Enough Notice".        
        </div>
         {!! Form::text('noticeDays', $daysNotice, ['id' => 'noticeDays','class' => 'form-control']) !!}
        <!-- Organization Type -->
        <div class="form-group">
            {!! Form::label('orgType', 'Organization Type', ['class' => 'lead']) !!}
            <div>If organization types are selected, any donation requests from organization that fall in non-selected categories will be flagged as "Pending rejection - Org Type".</div>
            @foreach ($rs as $r)
                <div class="">
                @if(($ruleRow->orgtype !== null) && in_array($r->id,$ruleRow->orgtype))
                    {{ Form::checkbox('orgTypeId[]' , $r->id, null, ['id' => $r->type_name, 'checked' => 'checked']) }} {{$r->type_name}}
                @else
                {{ Form::checkbox('orgTypeId[]' , $r->id, null, ['id' => $r->type_name]) }} {{$r->type_name}}
                @endif
                </div>    
            @endforeach
        </div>
        
        <!-- Tax Exempt -->
        <div class="form-group">
                {!! Form::label('taxEx', 'Tax Exempt', ['class' => 'lead']) !!}
                <div>If checked, any donation requests from organizations without 501c3 status will be flagged as "Pending Rejection - Not 501c3".</div>
                <div class="">
                @if ($ruleRow->taxex == '1')
                {{ Form::radio('taxex', '1', true, ['id' => 'tax','checked' => 'checked']) }} Yes
                <br />
                {{ Form::radio('taxex', '0', false, ['id' => 'tax']) }} No
                @else
                {{ Form::radio('taxex', '1', false, ['id' => 'tax']) }} Yes
                <br />
                {{ Form::radio('taxex', '0', true, ['id' => 'tax','checked' => 'checked']) }} No
                @endif                
                </div>
        

        <!-- Donation Type -->
        <div class="form-group">
                {!! Form::label('dtype', 'Donation Type', ['class' => 'lead']) !!}
                <div>By selecting the type(s) of donation requests you are willing to approve, any other requests will be flagged as "Pending Rejection - Donation type".</div>
                @foreach ($reqItemTypes as $reqItemType)
                <div class=""> 
                @if(($ruleRow->orgtype !== null) && in_array($reqItemType->id,$ruleRow->dntype))
                    {{ Form::checkbox('dtypeId[]', $reqItemType->id, null, ['id' => $reqItemType->item_name, 'checked' => 'checked'] ) }} {{$reqItemType->item_name}} </div>
                @else
                    {{ Form::checkbox('dtypeId[]', $reqItemType->id, null, ['id' => $reqItemType->item_name] ) }} {{$reqItemType->item_name}} </div>
                @endif
                @endforeach 
        </div>
        

        <!-- Amount requested -->
        <div class="form-group">
                {!! Form::label('amtReq', 'Amount requested', ['class' => 'lead']) !!}
                <div>If an amount is entered, any request that exceed this dollar amount will be flagged as "Pending Rejection - Exceeded Amount".</div>
        
                {!! Form::text('amtReq', $ruleRow->amtreq, ['id' => 'amtReq','class' => 'form-control']) !!}
                </div>

        <button class="btn btn-success" type="submit">save</button>
        {!! Form::close() !!} 
    </div>
        </div>
    </div>
</div>

@endsection
