@extends('admin.layouts.master')
@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Assign Role</h3>
        </div>
        {{ Form::open(['route' => 'assignRole', 'method' => 'POST']) }}
        <div class="card-body">
            <div class="form-group">
                {!! Form::label('user', 'User') !!}
                {!! Form::select('user', $users, null, [
                    'class' => 'form-control select2 col-3',
                    'placeholder' => 'Select User',
                    'data-placeholder' => 'Select User',
                ]) !!}
            </div>

            <h3>Roles :</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        @foreach ($roles as $role)
                            <div class=" col-lg-3 col-md- col-sm-6 col-xs-12">
                                <div class="checkbox no-margin">
                                    <label>
                                        {{ Form::checkbox('role[]', $role->id) }}
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
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