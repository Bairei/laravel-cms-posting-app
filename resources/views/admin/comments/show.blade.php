@extends('layouts.admin')

@section('styles')
    <style>
        .comment-text {
            -ms-word-break: break-all;
            word-break: break-all;

            /* Non standard for webkit */
            word-break: break-word;

            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            hyphens: auto;
        }
    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-6">
            <h3>Comment by {{$comment->author}}, {{$comment->email}}</h3>
            <p>Created on {{$comment->created_at}}.</p>
        </div>
    </div>
    <hr>
    <div>
        <div class="col-sm-2">
            <h4>Comment text:</h4>
        </div>
        <div class="col-sm-10 well comment-text">
            <i>{{$comment->body}}</i>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="col-sm-3">
                @if($comment->is_active)
                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                    <input type="hidden" name="is_active" value="0">
                    <div class="form-group">
                        {!! Form::submit('Unapprove', ['class'=>'btn btn-warning']) !!}
                    </div>

                    {!! Form::close() !!}
                @else
                    {!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}
                    <input type="hidden" name="is_active" value="1">
                    <div class="form-group">
                        {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                    </div>

                    {!! Form::close() !!}

                @endif
            </div>
            <div class="col-sm-3">
                {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$comments->render()}}
        </div>
    </div>

@endsection