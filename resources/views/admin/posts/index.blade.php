@extends('layouts.admin')

@section('content')

    @include('includes.flash_messages')

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
                <th>Details</th>
                <th>Comments</th>
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
                        <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
                        <td><a href="{{route('comments.showForPost', $post->id)}}">Comments</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->links()}}
        </div>
    </div>
@endsection