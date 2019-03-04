<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\User;
use Illuminate\Support\Facades\Storage;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $infoFromPrevious = session('infoFromPrevious');

        //Retrieve user info and convert file location to url
        $users = User::all();
        foreach ($users as $user){
            $user->profile_picture = Storage::url($user->profile_picture);
        }

        //Set default values (1.Default avatar url)
        $default = ['defaultProfilePicture' => Storage::url('public/files/pictures/profile/default.png')];
        return view('admin.users.index', compact('users', 'infoFromPrevious', 'default'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roleData = Role::pluck('name', 'id');
        $activeData = ['0' => 'Inactive', '1' => 'Active'];
        return view('admin.users.create', compact('roleData', 'activeData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //Prepare data from request
        $request['password'] = bcrypt($request->password);
        $request['profile_picture'] = $request->file('profile_picture_file')->store('public/files/pictures/profile');

        //Persist data into DB
        $user = (User::create($request->all()));

        //Flash success notice to the next request
        if(!empty($user))
            $result = [ 'info' => 'User data [' . $request->name . '] saved successfully.', 'classFlag' => 'success'];
        $request->session()->flash('infoFromPrevious', $result);

        //Redirect to index page
        return redirect('admin/users');
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
        return view('admin.users.show');
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
        return view('admin.users.edit');
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
