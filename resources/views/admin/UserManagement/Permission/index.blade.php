@extends('admin.layouts.master')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Permission Table</h3>
                <a class="card-tools" href="{{route('permission.create')}}"><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Module</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ucFirst($permission->module->name)}}</td>
                            <td>{{ucFirst($permission->name)}}</td>
                            <td>
                                <a href="{{route("permission.edit",['permission'=>$permission->id])}}"><i class="fas fa-edit"></i></a>&nbsp;
                                <a onclick='deleteItem("{{route("permission.destroy",["permission"=>$permission->id])}}")'><i class="fas fa-trash text-red"></i></a>
                            </td>
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
