@extends('admin.layouts.master')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role Table</h3>
                <a class="card-tools" href="{{route('role.create')}}"><i class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ucFirst($role->name)}}</td>
                            <td>
                                <a href="{{route("role.edit",['role'=>$role->id])}}"><i class="fas fa-edit"></i></a>&nbsp;
                                <a onclick='deleteItem("{{route("role.destroy",["role"=>$role->id])}}")'><i class="fas fa-trash text-red"></i></a>
                            </td>
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
