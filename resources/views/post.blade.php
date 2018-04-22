@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo ? $post->photo->name : null}}" alt="">

    <hr>

    <!-- Post Content -->

    <p>{{$post->body}}</p>

    <hr>

    @if(Session::has('comment_message'))
        <p class="alert alert-success">{{session('comment_message')}}</p>
    @endif

    <!-- Blog Comments -->

    <!-- Comment form -->
    @if(Auth::check())
        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store',]) !!}

                {!! Form::hidden('post_id', $post->id) !!}

                <div class="form-group">
                    {!! Form::label('body', 'Name:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}


        </div>
    @endif

    <hr>

    <!-- Posted Comments -->

    @if(count($comments) > 0)
        @foreach($comments as $comment)
            <div class="media">
                <a href="#" class="pull-left">
                    <img height="64px" class="media-object" src="{{$comment->photo? $comment->photo : '/images/placeholder.png'}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}} {{$comment->email}}
                        <small>{{$comment->created_at->diffForHumans()}}</small>
                    </h4>
                    <p>{{$comment->body}}</p>

                    <!-- Nested comment -->
                    @if(count($comment->replies()->whereIsActive(1)->get()) > 0)
                        @foreach($comment->replies()->whereIsActive(1)->get() as $reply)
                            <div id="nested-comment" class="media">
                                <a href="#" class="pull-left">
                                    <img height="64px" class="media-object" src="{{$reply->photo? $reply->photo : '/images/placeholder.png'}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author}} {{$reply->email}}
                                        <small>{{$reply->created_at->diffForHumans()}}</small>
                                    </h4>
                                    <p>{{$reply->body}}</p>
                                </div>
                            </div>

                            <br/>
                            @if(Auth::check())
                                @include('comment_form') <!-- Comment -->
                            @endif
                        @endforeach
                    @else
                        @include('comment_form') <!-- Comment -->
                    @endif

                </div>

            </div>
        @endforeach
    @endif

@endsection

@section('scripts')
    <script type="text/javascript">
        $(".comment-reply-container .toggle-reply").click(function () {
           $(this).next().slideToggle("slow");
        });
    </script>
@endsection