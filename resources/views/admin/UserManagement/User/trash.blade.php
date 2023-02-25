@extends('admin.layouts.master')
@section('main-content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Trash List</h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashUsers as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{route('restoreUser',['id'=>$user->id])}}"><i class="fa fa-trash-restore"></i></a>
                                    <a href="{{route('forceDeleteUser',['id'=>$user->id])}}"><i class="fa fa-trash text-red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                {{-- <ul class="pagination pagination-sm m-0 float-right">
                    {{ $trashUsers->appends(request()->input())->links()}}
                </ul> --}}
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
@endsection
