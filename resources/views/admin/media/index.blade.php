@extends('layouts.admin')

@section('content')

    @include('includes.flash_messages')

    <h1>Media</h1>
    @if($photos)
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img src="{{$photo->name}}" alt="" height="120px"></td>
                    <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit('Delete File', ['class'=>'btn btn-danger']) !!}
                        </div>

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

@endsection