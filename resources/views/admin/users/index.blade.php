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
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Active</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
        </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->is_active ? 'Active' : 'Inactive'}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @else
                <td colspan="6">No user found</td>
            @endif
        </tbody>
    </table>
@endsection
