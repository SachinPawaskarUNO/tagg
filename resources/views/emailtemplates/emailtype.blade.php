@extends('layouts.app')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:26px;">Available Email Templates</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">


                <div class="panel panel-default">
                    {{ csrf_field() }}
                    <div class="panel-heading">
                        <h1 style="text-align: left;">Select Email Templates</h1>
                    </div>

                    <div class="panel-body">
                            {!! Form::open(['action' =>  'EmailTemplateController@sendemail', 'method' => 'GET']) !!}

                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th>Email Type</th>
                                <th>Email Description</th>
                               
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            <tr>
                                @foreach($email_templates as $email_template)
                                    <td style="vertical-align: middle">{{ $email_template->emailTemplateTypes->template_type }}</td>
                                    <td style="vertical-align: middle">{{ $email_template->email_subject }}</td>
                                   
                                    <td style="vertical-align: middle">
                                        {{--  <a href="{{action('EmailTemplateController@sendemail', ['id' => $email_template->id])}}" id = "EditEmailTemp" class="btn btn-basic">Choose</a></td>  --}}
                                        <a href="" id = "EditEmailTemp" class="btn btn-basic">Choose</a></td>
                                        {{--  {!! Form::submit( 'Choose', ['class' => 'btn btn-basic', 'name' => 'submitbutton', 'value' => $email_template->id])!!}  --}}
                                    </tr>
                                @endforeach
                        </table>
                    </div>
                    {!! Form::open(['action' =>  'EmailTemplateController@sendemail', 'method' => 'GET']) !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('ids_string','' , array('id' => 'selected-ids-hidden')) }}
                    {{ Form::hidden('page_from', '/dashboard') }}
                    {{ Form::hidden('page_from', '/dashboard') }}
                    {{--add if condition to show approve and reject buttons only if there are pending requests and atleast one is selected--}}
                   
                    
                    {!! Form::close() !!}            
                </div>
            </div>
        </div>
    </div>
@endsection