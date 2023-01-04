<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $data['users']          =   User::paginate(10);

        return view('admin.UserManagement.User.index',$data);
    }

    public function create()
    {
        $data['user']           =   new User();
        $data['submitRoute']    =   'user.store';
        $data['method']         =   'POST';

        return view('admin.UserManagement.User.form',$data);
    }

    public function store(Request $request)
    {
        $user                   =   new User();
        $user->name             =   $request->name;      
        $user->email            =   $request->email;
        // $user->password         =   'Welcome@123';
        $user->is_active        =   empty($request->is_active) ? 0 : 1;  
        $user->is_admin         =   empty($request->is_admin) ? 0 : 1;  
        $user->save();
        
        return redirect(route('user.index'))->with('success','User Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['user']           =   User::findOrFail($id);
        $data['submitRoute']    =   ['user.update',['user'=>$id]];
        $data['method']         =   'PUT';
        $data['roles']          =   Role::all();

        return view('admin.UserManagement.User.form',$data);
    }

    public function update(Request $request, $id)
    {
        $user                   =   User::findOrFail($id);
        $user->name             =   $request->name;      
        $user->email            =   $request->email;
        // $user->password         =   'Welcome@123';
        $user->is_active        =   empty($request->is_active) ? 0 : 1;          
        $user->is_admin         =   empty($request->is_admin) ? 0 : 1;  
        $user->update();
        
        return redirect(route('user.index'))->with('success','User Updated');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }
}
