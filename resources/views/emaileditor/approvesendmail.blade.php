@extends('layouts.app')
@section('content')


    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=8ti9sy5hwrnyd1keswz66t0f6skecvy5wlkxwii3206xt0sp"></script>
    <script type="text/javascript">

        tinymce.init({
            selector: 'textarea',
            theme: 'modern',
            width: 745,
            height: 300,
            menubar: false,

            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | link image | print preview | PlaceHolders',
            //toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',

            setup: function(editor) {
                editor.addButton('PlaceHolders', {
                    type: 'menubutton',
                    text: 'Place Holders',
                    icon: false,
                    menu: [{
                        text: 'Addresee',
                        onclick: function () {
                            editor.insertContent('&nbsp;<b>{Addressee}</b>&nbsp;');
                        }
                    }, {
                        text: 'My Business Name',
                        onclick: function () {
                            editor.insertContent('&nbsp;<b>{My Business Name}</b>&nbsp;');
                        }
                    }]
                });
            }
        });

    </script>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header text-center" style="font-size:20px;font-weight: 900;">Approve and Send Email</h1>

            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>Approve and Send Email</h1>
                    </div>

                    <div class="panel-body">

                        {!! Form::model($email_template, ['method' => 'GET', 'route'=>['approveandsendmail'], 'class' => 'form-horizontal']) !!}

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::label('To', 'To:', ['class'=>'col-md-3 control-label' ]) !!}
                            <div class="col-lg-9" align="center">
                                {!! Form::text('To', $emails, ['class'=>'col-md-9 control-label', 'readonly'] ) !!}
                                {!! Form::hidden('firstNames', $firstNames) !!}
                                {!! Form::hidden('lastNames', $lastNames) !!}
                                {!! Form::hidden('status', 'Approve') !!}
                                {!! Form::hidden('ids_string', $ids_string) !!}
                                {!! Form::hidden('page_from', $page_from) !!}






                                {{--{!! Form::text('email_subject', null, ['required'], ['class' => 'form-control']) !!}--}}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('Email Subject', 'Email Subject:', ['class'=>'col-md-3 control-label']) !!}
                            <div class="col-lg-9">
                                {!! Form::text('email_subject', null, ['class' => 'form-control' , 'width'=> '1000px']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <!--div class="col-lg-6"-->
                            {!! Form::textarea('email_message', null, ['class' => 'col-md-4 control-label']) !!}
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Approve and Send', ['class' => 'btn savebtn']) !!}
                                @if (! empty($backPageFlag) && $backPageFlag == 'detailspage')
                                    <input class="btn backbtn" type="button" value="Cancel" onClick="history.go(-2);">
                                @else
                                    <input class="btn backbtn" type="button" value="Cancel" onClick="history.go(-1);">
                                @endif

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
