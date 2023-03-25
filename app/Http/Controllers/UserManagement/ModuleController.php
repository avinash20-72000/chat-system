<?php

namespace App\Http\Controllers\UserManagement;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ModuleRequest;

class ModuleController extends Controller
{
    public function index()
    {
        $this->authorize('view', new Module());

        $data['modules']            =   Module::paginate(10);

        return view('admin.UserManagement.Module.index', $data);
    }

    public function create()
    {
        $module                     =   new Module();
        $this->authorize('create', $module);

        $data['module']             =   $module;
        $data['submitRoute']        =   'module.store';
        $data['method']             =   'POST';

        return view('admin.UserManagement.Module.form', $data);
    }

    public function store(ModuleRequest $request)
    {
        $module                     =   new Module();
        $this->authorize('create', $module);

        $module->name               =   $request->name;
        $module->save();

        return redirect()->route('module.index')->with('success', 'Module Created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->authorize('update', new Module());

        $data['module']             =   Module::findOrFail($id);
        $data['submitRoute']       =   ['module.update', ['module' => $id]];
        $data['method']             =   'PUT';

        return view('admin.UserManagement.Module.form', $data);
    }

    public function update(ModuleRequest $request, $id)
    {
        $this->authorize('update', new Module());

        $module                     =   Module::findOrFail($id);
        $module->name               =   $request->name;
        $module->update();

        return redirect()->route('module.index')->with('success', 'Module Updated');
    }

    public function destroy($id)
    {
        $this->authorize('delete', new Module());

        Module::findOrFail($id)->delete();
    }
}
