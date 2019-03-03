{{--admin/users/create.blade.php--}}
@extends('layouts.admin')

@section('content')
    <h1>Create user</h1>
    <br>
    {!! Form::open([ 'method' => 'post', 'action' => 'AdminUsersController@store']) !!}
        <div class="form-row">
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Username') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Username']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('email', 'E-mail') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('role_id', 'Role') !!}
                {!! Form::select('role_id', $roleData, null, ['class' => 'form-control', 'placeholder' => 'Pick a role']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('is_active', 'Active Status') !!}
                {!! Form::select('is_active', $activeData, null, ['class' => 'form-control', 'placeholder' => 'Pick a status']) !!}
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::submit('Create user', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection
