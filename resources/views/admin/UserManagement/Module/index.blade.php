@extends('admin.layouts.master')
@section('main-content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Module Table</h3>
                @can('create',new App\Models\Module())
                    <a class="card-tools" href="{{route('module.create')}}"><i class="fas fa-plus"></i></a>
                @endcan
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            @canany(['update','delete'],new App\Models\Module())
                                <th>Action</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($modules as $module)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ucFirst($module->name)}}</td>
                            @canany(['update','delete'],new App\Models\Module())
                                <td>
                                    @can('update',new App\Models\Module())
                                        <a href="{{route("module.edit",['module'=>$module->id])}}"><i class="fas fa-edit"></i></a>&nbsp;
                                    @endcan
                                    @can('delete',new App\Models\Module())
                                        <a onclick='deleteItem("{{route("module.destroy",["module"=>$module->id])}}")'><i class="fas fa-trash text-red"></i></a>
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
                    {{ $modules->appends(request()->query())->links() }}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
