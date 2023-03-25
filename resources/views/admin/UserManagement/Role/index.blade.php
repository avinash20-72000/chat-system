@extends('admin.layouts.master')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Table</h3>
                @can('create',new app\Models\Role())
                    <a class="card-tools" href="{{route('role.create')}}"><i class="fas fa-plus"></i></a>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            @canany(['update','delete'],new app\Models\Role())
                                <th>Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ucFirst($role->name)}}</td>
                            @canany(['update','delete'],new app\Models\Role())
                                <td>
                                    @can('update',new app\Models\Role())
                                        <a href="{{route("role.edit",['role'=>$role->id])}}"><i class="fas fa-edit"></i></a>&nbsp;
                                    @endcan
                                    @can('delete',new app\Models\Role())
                                        <a onclick='deleteItem("{{route("role.destroy",["role"=>$role->id])}}")'><i class="fas fa-trash text-red"></i></a>
                                    @endcanany
                                </td>
                            @endcanany
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $roles->appends(request()->query())->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
