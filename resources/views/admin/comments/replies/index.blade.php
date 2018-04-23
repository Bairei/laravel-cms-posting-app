@extends('layouts.admin')

@section('content')

    @include('includes.flash_messages')

    @if(count($replies) > 0)
        <h1>Replies</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Created</th>
                <th>Post</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{str_limit($reply->body,30)}}</td>
                    <td>{{$reply->created_at}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>

                    <td>
                        <div class="row">
                            <div class="col-sm-6">
                                @if($reply->is_active)
                                    {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="0">
                                    <div class="form-group">
                                        {!! Form::submit('Unapprove', ['class'=>'btn btn-warning']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}
                                    <input type="hidden" name="is_active" value="1">
                                    <div class="form-group">
                                        {!! Form::submit('Approve', ['class'=>'btn btn-warning']) !!}
                                    </div>

                                    {!! Form::close() !!}

                                @endif
                            </div>
                            <div class="col-sm-6">
                                {!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}
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
                {{$replies->links()}}
            </div>
        </div>

    @else
        <h1 class="text-center">No Replies</h1>
    @endif

@endsection