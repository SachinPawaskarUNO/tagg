@extends('app')

@section('content')
    <h1>Security Questions</h1>
    <a href="{{url('/securityquestions/create')}}" class="btn btn-basic">Create Question</a>
    <hr>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th>Id</th>
            <th>Name</th>
            <th>Question</th>
            <th>Answer</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($securityquestions as $securityquestion)
            <tr>
                <td>{{ $securityquestion->user->id }}</td>
                <td>{{ $securityquestion->user->name }}</td>
                <td>{{ $securityquestion->question1}}</td>
                <td>{{ $securityquestion->answer1 }}</td>
                <td><a href="{{route('insertcheck', Auth::id())}}" class="btn btn-basic">Check</a></td>
                {{--<td><a href="{{route('securityquestions.edit',$securityquestion->id)}}" class="btn updatebtn">Update</a></td>--}}
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route'=>['securityquestions.destroy', $securityquestion->id]]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn backbtn']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
