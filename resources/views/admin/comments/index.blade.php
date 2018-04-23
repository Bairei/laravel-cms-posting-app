@extends('layouts.admin')

@section('content')

    @include('includes.flash_messages')

    @if(count($comments) > 0)
        <h1>Comments</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Body</th>
                    <th>Created</th>
                    <th>Post</th>
                    <th>Replies</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{str_limit($comment->body,30)}} <a href="{{route('comments.show', $comment->id)}}">More</a></td>
                        <td>{{$comment->created_at}}</td>
                        <td><a href="{{route('home.post', $comment->post->slug)}}">View Post</a></td>
                        <td><a href="{{route('replies.show', $comment->id)}}">View Replies</a></td>

                        <td>
                            <div class="row">
                                <div class="col-sm-6">
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
                                            {!! Form::submit('Approve', ['class'=>'btn btn-warning']) !!}
                                        </div>

                                        {!! Form::close() !!}

                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}
                                    <div class="form-group">
                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$comments->links()}}
            </div>
        </div>

    @else
        <h1 class="text-center">No comments</h1>
    @endif

@endsection