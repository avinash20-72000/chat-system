<?php

namespace App\Http\Controllers\UserManagement;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('view', new User());

        $data['users']          =   User::withoutGlobalScopes()->paginate(10);

        return view('admin.UserManagement.User.index', $data);
    }

    public function create()
    {
        $user                   =   new User();   
        $this->authorize('create', $user);

        $data['user']           =   $user;
        $data['submitRoute']    =   'user.store';
        $data['method']         =   'POST';

        return view('admin.UserManagement.User.form', $data);
    }

    public function store(UserRequest $request)
    {
        $user                   =   new User();
        $this->authorize('create', $user);

        $user->name             =   $request->name;
        $user->email            =   $request->email;
        $user->is_active        =   empty($request->is_active) ? 0 : 1;
        $user->is_admin         =   empty($request->is_admin) ? 0 : 1;
        $user->save();

        return redirect(route('user.index'))->with('success', 'User Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('update', new User());

        $data['user']           =   User::findOrFail($id);
        $data['submitRoute']    =   ['user.update', ['user' => $id]];
        $data['method']         =   'PUT';
        $data['roles']          =   Role::all();

        return view('admin.UserManagement.User.form', $data);
    }

    public function update(UserRequest $request, $id)
    {
        $this->authorize('update', new User());

        $user                   =   User::findOrFail($id);
        $user->name             =   $request->name;
        $user->email            =   $request->email;
        $user->is_active        =   empty($request->is_active) ? 0 : 1;
        $user->is_admin         =   empty($request->is_admin) ? 0 : 1;

        if ($request->hasFile('image')) {
            if (!empty($user->image)) {
                $fileName   = 'image/user/' . $user->image;
                if (Storage::exists($fileName)) {
                    Storage::delete($fileName);
                }    
            }
            $userImage = request()->name . Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(storage_path('app/image/user'), $userImage);
            $user->image            =   $userImage;
        }
        $user->age              =   $request->age;
        $user->gender           =   $request->gender;
        $user->update();

        return redirect(route('user.index'))->with('success', 'User Updated');
    }

    public function destroy($id)
    {
        $this->authorize('delete', new User());

        $user = User::findOrFail($id);
        $user->update(['is_active'=>0]);
        $user->delete();
    }

    public function trashList()
    {
        $this->authorize('restore', new User());

        $data['trashUsers']     =    User::withoutGlobalScopes()->onlyTrashed()->get();

        return view('admin.UserManagement.User.trash',$data);
    }

    public function restore($id)
    {       
        $this->authorize('restore', new User());
 
        $user       =   User::withoutGlobalScopes()->withTrashed()->findOrFail($id);
        $user->update(['is_active'=>1]);
        $user->restore();

        return back()->with('success','User Restore');
    }

    public function forceDelete($id)
    {
        $this->authorize('forceDelete', new User());

        User::withTrashed()->find($id)->forceDelete();

        return back()->with('success','User Delete');
    }

    public function assignRoles(Request $request)
    {        
        $this->authorize('create', new User());
        $userid         = $request->input('user');
        $user           = User::with('roles')->find($userid);
        $roles          = $request->input('role'); // array of role ids
        if (empty($roles)) {
            $roles      = array();
        }
        $user->roles()->sync($roles);
        return redirect()->back()->with('success', 'Role Assigned Successful');
    }

    public function getImage($fileName)
    {
        $path       =  storage_path().'/app/image/user/'.$fileName;
        $filedata   =  file_get_contents($path);
        
        return Response::make($filedata);
    }

    public function storeStatus($id,$status,$logout)
    {
        $user                   =   User::findOrFail($id);
        $user->online_status    =   $status;
        if(!empty($logout))
        {
            $user->logout       =   $logout;
        }
        $user->save();

        return;
    }

    public function roleAssign()
    {
        $data['users']          =   User::pluck('name','id')->toArray();
        $data['roles']          =   Role::all();

        return view('admin.UserManagement.User.roleAssign',$data);
    }

    public function onlineStatus(Request $request)
    {
        dd( $request->session()->get('online_status'));
    }
}
