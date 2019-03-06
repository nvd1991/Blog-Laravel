{{--admin/posts/index.blade.php--}}
@extends('layouts.admin')

@section('content')
    @if(isset($infoFromPrevious))
        <div class="alert alert-{{$infoFromPrevious['classFlag']}}" role="alert">
            {{$infoFromPrevious['info']}}
        </div>
    @endif
    <h1>Posts</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Photo</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">User</th>
            <th scope="col">Category</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td><img width="20" height="20"
                             src="{{asset($post->post_photo) != asset('/storage/') ? asset($post->post_photo) : asset($default['defaultPostPhoto'])}}"
                             alt="post photo"></td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->category->name}}</td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                    <td>
                        <form style="display: inline-block">
                            <button style="font-size: 1rem;" class="btn btn-primary" formaction="{{route('posts.edit', ['post' => $post->id])}}">Edit</button>
                        </form>
                        <form style="display: inline-block" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <button style="font-size: 1rem;" class="btn btn-danger" formaction="{{route('posts.destroy', ['post' => $post->id])}}">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <td colspan="6">No post found</td>
        @endif
        </tbody>
    </table>
@endsection

