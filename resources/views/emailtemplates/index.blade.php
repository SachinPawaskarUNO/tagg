@extends('layouts.app')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Email Templates</h1>

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
                        <h1 style="text-align: left;font-weight: bold;">Edit Email Templates Here</h1>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th>Email Type</th>
                                <th>Email Subject</th>
                               
                                <th colspan="3"></th>
                            </tr>
                            </thead>
                            <tr>
                                @foreach($email_templates as $email_template)
                                    <td style="vertical-align: middle">{{ $email_template->emailTemplateTypes->template_type }}</td>
                                    <td style="vertical-align: middle">{{ $email_template->email_subject }}</td>
                                   
                                    <td style="vertical-align: middle"><a href="
                                    {{action('EmailTemplateController@edit', ['id' => encrypt($email_template->id)])}}" id = "EditEmailTemp" class="btn savebtn" style="background-color: #0099CC;">Edit</a></td>
                                </tr>
                                @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection