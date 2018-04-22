@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
@endsection

@section('content')
    <h1>New Photo</h1>

    {!! Form::open(['method' => 'POST', 'action' => 'AdminMediaController@store', 'files' => true, 'class' => 'dropzone']) !!}

    {{--<div class="form-group">--}}
        {{--{!! Form::label('name', 'Name:') !!}--}}
        {{--{!! Form::file('name', ['class'=>'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--{!! Form::submit('Upload', ['class'=>'btn btn-primary']) !!}--}}
    {{--</div>--}}

    {!! Form::close() !!}

@endsection

@section('scripts')
    <script src="{{asset('js/dropzone.js')}}"></script>
@endsection