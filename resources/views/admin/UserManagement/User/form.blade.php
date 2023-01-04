@extends('admin.layouts.master')
@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">User Form</h3>
        </div>
        {{Form::model($user,['route'=>$submitRoute, 'method' => $method])}}
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name','Name') }}
                    {{ Form::text('name', null ,['class'=>'from-control col-md-4', 'placeholder' => 'Enter Name' ]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email','Email') }}
                    {{ Form::email('email', null ,['class'=>'from-control col-md-4', 'placeholder' => 'Enter Email' ]) }}
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Active Only</label>
                            <div class="col-form-label">
                                <div class="form-check">
                                    {{ Form::checkbox('is_active') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Is Admin</label>
                            <div class="col-form-label">
                                <div class="form-check">
                                    {{ Form::checkbox('is_admin') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        {{ Form::close() }}
    </div>

    @if(!empty($user->id))
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assign Roles</h4>
                        {{ Form::open(['route' => 'assignRole']) }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::hidden('user', $user->id) }}
                                    <div class="form-group row">
                                        @foreach ($roles as $role)
                                            <div class=" col-lg-3 col-md- col-sm-6 col-xs-12">
                                                <div class="checkbox no-margin">
                                                    <label>
                                                        {{ Form::checkbox('role[]', $role->id, $user->hasRole($role->name)) }}
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        @endif
@endsection
