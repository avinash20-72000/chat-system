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
@endsection
