<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Permission());

        $data['permissions']            =   Permission::with('module')->paginate(10);

        return view('admin.UserManagement.Permission.index',$data);
    }

    public function create()
    {
        $permission                     =   new Permission();
        $this->authorize('create', $permission);

        $data['permission']             =   $permission;
        $data['submitRoute' ]           =   'permission.store';
        $data['method']                 =   'POST';
        $data['modules']                =   Module::pluck('name','id')->toArray();

        return view('admin.UserManagement.Permission.form',$data);
    }

    public function store(PermissionRequest $request)
    {
        $permission                     =   new Permission();
        $this->authorize('create', $permission);

        $permission->name               =   $request->name;
        $permission->module_id          =   $request->module_id;
        $permission->save();

        return redirect()->route('permission.index')->with('success','Permission Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('update', new Permission());

        $data['permission']             =   Permission::findOrFail($id);
        $data['submitRoute' ]           =   ['permission.update',['permission'=>$id]];
        $data['method']                 =   'PUT';
        $data['modules']                =   Module::pluck('name','id')->toArray();

        return view('admin.UserManagement.Permission.form',$data);
    }

    public function update(PermissionRequest $request, $id)
    {
        $this->authorize('update', new Permission());

        $permission                     =   Permission::findOrFail($id);
        $permission->name               =   $request->name;
        $permission->module_id          =   $request->module_id;
        $permission->update();

        return redirect()->route('permission.index')->with('success','Permission Updated');
    }

    public function destroy($id)
    {
        $this->authorize('delete', new Permission());
        Permission::findOrFail($id)->delete();
    }
}
