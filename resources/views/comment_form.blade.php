@if(Auth::check())
    <div class="comment-reply-container">
        <button class="toggle-reply btn btn-primary pull-right">Reply</button>
        <!-- Reply Form -->
        <div class="comment-reply row">
            {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply', 'class'=>'col-sm-6']) !!}

            {!! Form::hidden('comment_id', $comment->id ) !!}
            {!! Form::hidden('post_id', $post->id) !!}

            <div class="form-group">
                {!! Form::label('body', 'Body:') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Reply', ['class'=>'btn btm-sm btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>

    </div>
@endif