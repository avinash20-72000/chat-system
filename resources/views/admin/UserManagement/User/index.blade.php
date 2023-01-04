@extends('admin.layouts.master')
@section('main-content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User List</h3>
                <p class="card-tools"><a href="{{ route('user.create') }} "><i class="fa  fa-plus"></i></a></p>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th style="width: 40px">Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->is_active == 1)
                                        <i class="fa fa-check-circle text-green"></i>
                                    @else
                                        <i class="fa fa-times-circle text-red"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('user.edit',['user'=>$user->id])}}"><i class="fa fa-edit"></i></a>
                                    <a onclick='deleteItem("{{route("user.destroy",["user"=>$user->id])}}")'><i class="fa fa-trash text-red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    {{ $users->appends(request()->input())->links()}}
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
@endsection
