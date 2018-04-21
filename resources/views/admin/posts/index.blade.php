@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_post'))
        <div class="alert alert-danger">{{session('deleted_post')}}</div>
    @endif
    @if(Session::has('created_post'))
        <div class="alert alert-success">{{session('created_post')}}</div>
    @endif
    @if(Session::has('edited_post'))
        <div class="alert alert-info">{{session('updated_post')}}</div>
    @endif

    <h1>Posts</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Post photo</th>
                <th>Created by</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
            @if($posts)
                @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td><img src="{{$post->photo? $post->photo->name : '/images/placeholder.png'}}" height="50px"></td>
                        {{--<td>{{$post->photo_id}}</td>--}}
                        <td><a href="{{route('posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
                        <td>{{$post->category? $post->category->name : 'Uncategorized'}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{str_limit($post->body, 30)}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection