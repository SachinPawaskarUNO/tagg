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
                    <div class="panel-heading">
                        <h1 style="text-align: left;font-size:22px;">Select Email Templates</h1>
                    </div>
                    <div class="panel-body">
                            {!! Form::open(['action' => 'EmailTemplateController@sendemail', 'method' => 'GET']) !!}
                            {{ csrf_field() }}
                            <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th>Email Type</th>
                                <th>Email Description</th>
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            @foreach($email_templates as $email_template)
                            <tr>
                                    <td style="vertical-align: middle">{{ $email_template->emailTemplateTypes->template_type }}</td>
                                    <td style="vertical-align: middle">{{ $email_template->email_subject }}</td>
                                    <td style="vertical-align: middle"> 
                                    <input type="radio" class="myCheckbox" name="emailtype" id ="EditEmailTemp" ids="{{$email_template->id}}"/>Choose</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    {!! Form::hidden('organization_id', $email_template->organization_id) !!}
                    {!! Form::hidden('emailid','' , array('id' => 'selected-ids-hidden')) !!}
                    {!! Form::hidden('ids_string',$ids_string) !!}
                    {!! Form::hidden('lastNames', $lastNames) !!}
                    {!! Form::hidden('emails', $emails) !!}
                    {!! Form::hidden('firstNames', $firstNames) !!}
                    {!! Form::hidden('page_from', '/dashboard') !!}
                    {!! Form::submit('Proceed', ['class' => 'btn btn-basic', 'name' => 'submitbutton', 'value' => 'approve']) !!}                    
                    {!! Form::close() !!}            
                </div>
            </div>
        </div>
    </div>

    <script>
    var idsArray;

            // Populating array with the list of checkboxes with
            // checked ids
            $("input[name='emailtype']:radio").change(function() {
            //$('.myCheckbox:input[ids]').change(function () {
                var id = $(this).attr('ids');
                if(this.checked) {
                    idsArray = id;
               // } else {
                 //   idsArray.splice(idsArray.indexOf(id), 1);
                }//
                $('#selected-ids-hidden').val(idsArray);
            });
    </script>

@endsection