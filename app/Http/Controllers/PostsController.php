<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Retrieve flash data to display
        $infoFromPrevious = session('infoFromPrevious');

        //Retrieve post info and convert file location to url
        $posts = Post::all();
        foreach ($posts as $post){
            $post->post_photo = Storage::url($post->post_photo);
        }

        //Set default values (1.Default post photo url)
        $default = ['defaultPostPhoto' => Storage::url('public/files/pictures/post/default.png')];
        return view('admin.posts.index', compact('posts', 'infoFromPrevious', 'default'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Retrieve category data
        $categoryData = Category::pluck('name', 'id');
        return view('admin.posts.create', compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        //Solution 2: Creation from relationship
        //Prepare data from request
        $user = Auth::user();
        if($file = $request->file('post_photo_file'))
            $request['post_photo'] = $file->store('public/files/pictures/post');

        //Persist data into DB
        //Instead of App\Post::create, we can take user and use relationship (user_id to id) to auto-fill this field like below
        $post = $user->posts()->create($request->all());

        //Flash success notice to the next request
        if(!empty($post))
            $result = [ 'info' => 'Post data [' . $request->title . '] saved successfully.', 'classFlag' => 'success'];
        $request->session()->flash('infoFromPrevious', $result);

        //Redirect to index page
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
