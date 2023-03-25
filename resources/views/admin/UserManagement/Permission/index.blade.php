@extends('admin.layouts.master')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Table</h3>
                @can('create',new App\Models\Permission())
                    <a class="card-tools" href="{{route('permission.create')}}"><i class="fas fa-plus"></i></a>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Module</th>
                            <th>Permission</th>
                            @canany(['update','delete'],new App\Models\Permission())
                                <th>Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ucFirst($permission->module->name)}}</td>
                            <td>{{ucFirst($permission->name)}}</td>
                            @canany(['update','delete'],new App\Models\Permission())
                                <td>
                                    @can('update',new App\Models\Permission())
                                        <a href="{{route("permission.edit",['permission'=>$permission->id])}}"><i class="fas fa-edit"></i></a>&nbsp;
                                    @endcan
                                    @can('delete',new App\Models\Permission())
                                        <a onclick='deleteItem("{{route("permission.destroy",["permission"=>$permission->id])}}")'><i class="fas fa-trash text-red"></i></a>
                                    @endcan
                                </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $permissions->appends(request()->query())->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
