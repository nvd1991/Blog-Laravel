{{--admin/posts/edit.blade.php--}}
@extends('layouts.admin')

@section('content')
    <h1>Edit user</h1>
    <br>
    @include('includes.form_error')

    {!! Form::model($post, ['method' => 'patch', 'route' => ['posts.update', $post->id], 'files' => true]) !!}
    <div class="form-row">
        <div class="form-group col-md-2">
            {!! Html::image(asset($post->post_photo) != asset('/storage/') ? asset($post->post_photo) : asset($default['defaultPostPhoto']), 'post photo', ['class' => 'img-thumbnail']) !!}
        </div>
        <div class="form-group col-md-10">
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
                    {!! Form::select('category_id', $categoryData, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <div class="custom-file">
                        {!! Form::file('post_photo_file', ['class' => 'custom-file-input']) !!}
                        {!! Form::label('post_photo_file', null, ['class' => 'custom-file-label']) !!}
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    {!! Form::submit('Update info', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@endsection
