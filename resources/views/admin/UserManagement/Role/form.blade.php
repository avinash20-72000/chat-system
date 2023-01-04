@extends('admin.layouts.master')
@section('main-content')
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Role Form</h3>
                </div>
                {{Form::model($role,['route'=>$submitRoute, 'method'=>$method])}}
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('name', 'Role') }}
                            {{Form::text('name',null,['class'=>'form-control col-5' , 'placeholder'=>"Enter Role"])}}
                        </div>
                       
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                {{Form::close()}}
            </div>
            
            @if($role->id)
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Assign Permissions</h3>
                    </div>
                    {{ Form::open(['route' => ['assignPermissions',['role' => $role->id]]]) }}
                    {{ Form::hidden('role', $role->id) }}
                    <div class="card-body">
                        <div class="form-group row">
                            @foreach ($permissions as $module_name => $permission)
                            <div class="card-body col-md-12 col-xs-12 col-sm-12 border-bottom">
                                <h4 class="card-footer">{{ strtoupper($module_name) }}:</h4>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($permission as $permission)
                                        <div class="col-sm-3">
                                            <div class="checkbox">
                                                <label  class="">
                                                    {{ Form::checkbox('permission[]', $permission->id, $role->hasPermission($permission->module->name, $permission->name)) }}
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    {{ Form::close() }}
                </div>
            @endif
        </div>
    </div>
@endsection
