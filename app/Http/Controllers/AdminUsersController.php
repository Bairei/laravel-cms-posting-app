<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $users = User::paginate(5);
        return view ('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //

        $input = $request->all();

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['name' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($input['password']);

        User::create($input);

        session()->flash('created', 'The user has been created successfully.');

        return redirect('/admin/users');
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
       $user = User::findOrFail($id);
       if ($request->password == ''){
           $input = $request->except('password');
       } else {
           $input = $request->all();
           $input['password'] = bcrypt($input['password']);
       }

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['name' => $name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);
        session()->flash('edited', 'The user with id ' . $id . ' has been edited successfully.');
        return redirect(route('users.index'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->id != $user->id) {
            if($user->photo){
                unlink(public_path() . $user->photo->name);
            }
            $user->delete();
            session()->flash('deleted', 'The user with id ' . $id . ' has been deleted.');
        }



        return redirect(route('users.index'));
    }
}
