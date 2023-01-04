@extends('admin.layouts.master')
@section('main-content')
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Permission Form</h3>
                </div>
                {{Form::model($permission,['route'=>$submitRoute, 'method'=>$method])}}
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{ Form::label('module_id', 'Select Module') }}
                                {{Form::select('module_id',$modules, null,['class'=>'form-control select2 col-8' , 'placeholder'=>"Select Module"])}}
                            </div>
                            
                            <div class="form-group col-md-6">
                                {{ Form::label('name', 'Permission') }}
                                {{Form::text('name',null,['class'=>'form-control col-8' , 'placeholder'=>"Enter Permission"])}}
                            </div>
                        </div>
                       
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                {{Form::close()}}
            </div>

        </div>
    </div>
@endsection
