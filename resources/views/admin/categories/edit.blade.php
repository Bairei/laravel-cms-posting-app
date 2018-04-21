@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>

    <div class="col-sm-6">

        @include ('includes.form_error')
        {!! Form::open(['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id ]]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', $category->name, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-2']) !!}
            </div>

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id ],'class'=>'col-sm-4','style'=>'padding-left:2em;']) !!}

        <div class="form-group">
            {!! Form::submit('Remove Category', ['class'=>'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    <div class="col-sm-6">

    </div>

@endsection