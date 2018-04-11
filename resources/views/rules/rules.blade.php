@extends('layouts.app')
@section('css')
    <!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://querybuilder.js.org/assets/css/docs.min.css" rel="stylesheet">
    <link href="http://querybuilder.js.org/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

@endsection
@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
@endsection
@section('content')

<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:26px;">Donation Preferences</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    
                        CharityQ allows you to optionally select criteria based on your donation preferences. Requests not meeting your selected
                            criteria or that would be over budget will be flagged as "Pending Rejection" to guide you when reviewing requests.
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
                
                {!! Form::label('monthlyBudget', 'Monthly Budget', ['class' => 'lb-lg']) !!} 
                <div>
                    By setting a monthly budget, any requests that come in after your budget is reached will be flagged as "Pending Rejection - Budget".
                </div>
                <div class="input-group col-xs-2"> 
                    <span class="input-group-addon">$</span>
                    {!! Form::text('monthlyBudget', number_format(round($monthlyBudget)), ['id' => 'monthlyBudget', 'class' => 'form-control col-xs-3', 'min' => '0', 'placeholder' => '0',  'maxlength' => '7' ]) !!}
                </div>                
            </div>
            <!-- Notice Days -->
            <div class="form-group">
                {!! Form::label('noticeDays', 'Notice Needed', ['class' => 'lb-lg']) !!}
                <div>By setting a number of days notice you need before the donation is due, any requests that do not meet the days notice required will be flagged as "Pending Rejection - Not Enough Notice".        
                </div>
                <div class="input-group col-xs-2">
                        {!! Form::number('noticeDays', $daysNotice, ['id' => 'noticeDays', 'class' => 'form-control', 'min' => '0', 'max' => '365', 'placeholder' => '0',  'maxlength' => '3' ]) !!}
                        <span class="input-group-addon" id="basic-addon2">Days</span>
                </div>
            </div>
            <!-- Organization Type -->
            <div class="form-group">
                {!! Form::label('orgType', 'Organization Type(s) Not Supported', ['class' => 'lb-lg']) !!}
                <div>If organization types are selected, any donation requests from organizations that fall in selected categories will be flagged as "Pending Rejection - Org Type".</div>
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
                    {!! Form::label('taxEx', 'Tax Exempt Only', ['class' => 'lb-lg']) !!}
                    <div>If Yes is selected, any donation requests from organizations without 501c3 status will be flagged as "Pending Rejection - Not a 501c3".</div>
                    <div class="">
                    @if ($ruleRow->taxex == '1')
                    {{ Form::radio('taxex', '1', true, ['id' => 'yes','checked' => 'checked']) }} Yes, Must be tax exempt. 
                    <br />
                    {{ Form::radio('taxex', '0', false, ['id' => 'no']) }} No
                    @else
                    {{ Form::radio('taxex', '1', false, ['id' => 'yes']) }} Yes, Must be tax exempt.
                    <br />
                    {{ Form::radio('taxex', '0', true, ['id' => 'no','checked' => 'checked']) }} No
                    @endif                
                    </div>
            
            <!-- Donation Type -->
            <div class="form-group">
                    {!! Form::label('dtype', 'Donation Type(s) Accepted', ['class' => 'lb-lg']) !!}
                    <div>
                        By selecting the type(s) of donation requests you are willing to approve, any other requests will be flagged as "Pending Rejection - Donation Type".
                    </div>
                    @foreach ($reqItemTypes as $reqItemType)
                    
                    @if(($ruleRow->dntype !== null) && in_array($reqItemType->id,$ruleRow->dntype))
                    <div class="">
                    {{ Form::checkbox('dtypeId[]', $reqItemType->id, null, ['id' => $reqItemType->item_name, 'checked' => 'checked'] ) }} {{$reqItemType->item_name}} 
                    </div>
                    @else
                    <div class="">
                    {{ Form::checkbox('dtypeId[]', $reqItemType->id, null, ['id' => $reqItemType->item_name] ) }} {{$reqItemType->item_name}} 
                    </div>
                    @endif
                    @endforeach 
            </div>
            

            <!-- Amount requested -->
            <div class="form-group">
                    {!! Form::label('amtReq', 'Maximum Amount Per Request', ['class' => 'lb-lg']) !!}
                    <div>If an amount is entered, any request that exceed this dollar amount will be flagged as "Pending Rejection - Exceeded Amount".</div>
                    <div class="input-group col-xs-2"> 
                        <span class="input-group-addon">$</span>
                        {!! Form::text('amtReq',number_format(round($ruleRow->amtreq)), ['id' => 'amtReq', 'class' => 'form-control', 'min' => '0', 'placeholder' => '0', 'maxlength' => '7' ]) !!}
                    </div>
            </div>

            <button class="btn btn-basic" type="submit">Save</button>
            {!! Form::close() !!} 
        </div>
        </div>
    </div>
</div>
 <script>
    $('#monthlyBudget').number();
    $('#amtReq').number();
    $("#monthlyBudget").keyup(function () {
        new_val = $("#monthlyBudget").val().replace(/[^0-9\.]/g, '');
        new_val = parseInt(new_val);
        new_val_formatted = new_val.toLocaleString("en");
        if (new_val_formatted != 'NaN') {
            $('#monthlyBudget').val(new_val_formatted);
        }
        else {
            $('#monthlyBudget').val('');
        }
    });

    
    $("#amtReq").keyup(function () {
        new_val = $("#amtReq").val().replace(/[^0-9\.]/g, '');
        new_val = parseInt(new_val);
        new_val_formatted = new_val.toLocaleString("en");
        if (new_val_formatted != 'NaN') {
            $('#amtReq').val(new_val_formatted);
        }
        else {
            $('#amtReq').val('');
        }
    });

    $('button').on("click", function() {
    var m = $('#monthlyBudget').val();
    m = m.replace(/,/g, "");
    $('#monthlyBudget').val(m);
    
    var a = $('#amtReq').val();
    a = a.replace(/,/g, "");
    $('#amtReq').val(a);
    });
   </script>
@endsection
