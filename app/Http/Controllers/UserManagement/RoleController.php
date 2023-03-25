<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Role());

        $data['roles']          =   Role::paginate(10);

        return view('admin.UserManagement.Role.index',$data);
    }

    public function create()
    {
        $role                   =   new Role();
        $this->authorize('create', $role);

        $data['role']           =   $role;
        $data['submitRoute' ]   =   'role.store';
        $data['method']         =   'POST';

        return view('admin.UserManagement.Role.form',$data);
    }

    public function store(RoleRequest $request)
    {
        $role                   =   new Role();
        $this->authorize('create', $role);

        $role->name             =   $request->name;
        $role->save();

        return redirect()->route('role.index')->with('success','Role Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('update', new Role());

        $data['role']           =   Role::findOrFail($id);
        $data['submitRoute' ]   =   ['role.update',['role'=>$id]];
        $data['method']         =   'PUT';
        $data['permissions']    = 	Permission::with('module')->get()->groupBy('module.name');

        return view('admin.UserManagement.Role.form',$data);
    }

    public function update(RoleRequest $request, $id)
    {
        $this->authorize('update', new Role());

        $role                   =   Role::findOrFail($id);
        $role->name             =   $request->name;
        $role->update();

        return redirect()->route('role.index')->with('success','Role Updated');
    }

    public function destroy($id)
    {
        $this->authorize('delete', new Role());

        Role::findOrFail($id)->delete();
    }

    public function assignPermissions(Request $request)
    {
        $this->authorize('create', new Role());

        $roleId                = $request->input('role');
        $role                  = Role::findOrFail($roleId);
        $permissions           = $request->input('permission');// return array of permission id
        $role->permissions()->sync($permissions);

        $action     = "Permission Assigned: $role->name";

        return back()->with('success', 'Permission Assigned Successfully');
    }
}
