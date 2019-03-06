{{--admin/posts/create.blade.php--}}
@extends('layouts.admin')

@section('content')
    <h1>Create Post</h1>
    <br>
    @include('includes.form_error')

    {!! Form::open([ 'method' => 'post', 'action' => 'PostsController@store', 'files' => true]) !!}
    <div class="form-row">
        <div class="form-group col-md-12">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title']) !!}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            {!! Form::label('body', 'Body') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Post body']) !!}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', $categoryData, 0, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <div class="custom-file">
                {!! Form::file('post_photo_file', ['class' => 'custom-file-input']) !!}
                {!! Form::label('post_photo_file', 'Post photo', ['class' => 'custom-file-label']) !!}
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            {!! Form::submit('Create post', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection
