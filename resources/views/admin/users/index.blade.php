@extends('layouts.admin')

@section('content')

    @if(Session::has('deleted_user'))
        <div class="alert alert-danger">{{session('deleted_user')}}</div>
    @endif
    @if(Session::has('user_created'))
        <div class="alert alert-success">{{session('user_created')}}</div>
    @endif
    @if(Session::has('user_updated'))
        <div class="alert alert-info">{{session('user_updated')}}</div>
    @endif

    <h1>Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img src="{{$user->photo? $user->photo->name : '/images/placeholder.png'}}" height="50px" width="50px"></td>
                    <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    @if($user->role)
                        <td>{{$user->role->name}}</td>
                    @else
                        <td>None</td>
                    @endif
                    <td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
                    @if($user->created_at)
                        <td>{{$user->created_at->diffForHumans()}}</td>
                    @else
                        <td>--</td>
                    @endif
                    @if($user->updated_at)
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    @else
                        <td>--</td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection