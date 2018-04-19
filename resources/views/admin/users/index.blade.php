@extends('layouts.admin')

@section('content')

    <h1>Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
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
                    <td>{{$user->name}}</td>
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