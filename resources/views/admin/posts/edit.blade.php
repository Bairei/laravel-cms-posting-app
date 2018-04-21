@extends('layouts.admin')

@section('content')
    <h1>Edit post</h1>


    <div class="row">
        <div class="col-sm-3">
            <img src="{{$post->photo? $post->photo->name: '/images/placeholder.png'}}" alt="" class="img-responsive img-rounded">
        </div>
        <div class="col-sm-9">
            {!! Form::open(['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', $post->title, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', [''=>'Options'] + $categories, $post->category? $post->category->id : '', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('body', 'Description:') !!}
                {!! Form::textarea('body', $post->body, ['class'=>'form-control', 'rows' => 3]) !!}
            </div>

            <div class="form-group col-sm-1">
                {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id], 'class' => 'col-sm-1', 'style'=> 'padding-left: 2em;']) !!}

            <div class="form-group">
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}


        </div>
    </div>

    <div class="row">
        @include('includes.form_error')
    </div>
@endsection