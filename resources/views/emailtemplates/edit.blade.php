@extends('layouts.app')
@section('content')
<br>

 <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey={{env('TINYMCE_API_KEY')}}"></script>



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
                  text: 'Addressee',
                  onclick: function () {
                      editor.insertContent('&nbsp;<b>{Addressee}</b>&nbsp;');
                  }
              }, {
                  text: 'My Business Name',
                  onclick: function () {
                      editor.insertContent('&nbsp;<b>{My Business Name}</b>&nbsp;');
                  }
              }],
          });
      }
  });

    </script>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1 style="text-align: left;">Update Template</h1></div>

                    <div class="panel-body">

                        {!! Form::model($email_template, ['method' => 'PUT', 'route'=>['emailtemplates.update', $email_template->id], 'class' => 'form-horizontal']) !!}

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
                            <label for="Email Subject" class="col-md-3 control-label">Email Subject <span style="color: red; font-size: 20px; vertical-align:middle;">*</span></label>
                            <div class="col-lg-9">
                                {!! Form::text('email_subject', null, ['class' => 'form-control' , 'width'=> '1000px']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                        <!--div class="col-lg-6"-->
                              {!! Form::textarea('email_message', null, ['required'], ['class' => 'col-md-4 control-label']) !!}
                                                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit('Update', ['class' => 'btn btn-basic', 'id' => 'update']) !!}
                               <a href="{{ route('emailtemplates.index')}}" id = 'Cancel' class="btn backbtn">Cancel</a>
                                <span style="color: red"> <h5>Fields Marked With (<span
                                                style="color: red; font-size: 20px;text-align: center">*</span>) Are Mandatory </h5></span>

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
