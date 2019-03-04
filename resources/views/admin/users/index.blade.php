{{--admin/users/index.blade.php--}}
@extends('layouts.admin')

@section('content')
    @if(isset($infoFromPrevious))
        <div class="alert alert-{{$infoFromPrevious['classFlag']}}" role="alert">
            {{$infoFromPrevious['info']}}
        </div>
    @endif
    <h1>Users</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Profile</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Active</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td><img width="20" height="20"
                             src="{{asset($user->profile_picture) != asset('/storage/') ? asset($user->profile_picture) : asset($default['defaultProfilePicture'])}}"
                             alt="profile picture"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active ? 'Active' : 'Inactive'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>
                        <form>
                            <button style="font-size: 1rem;" class="btn btn-primary" formaction="{{route('users.edit', ['user' => $user->id])}}">Edit</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <td colspan="6">No user found</td>
        @endif
        </tbody>
    </table>
@endsection
