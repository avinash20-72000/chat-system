@extends('admin.layouts.master')
@section('main-content')
    <div class="row">

        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Module Form</h3>
                </div>
                {{Form::model($module,['route'=>$submitRoute, 'method'=>$method])}}
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('name', 'module') }}
                            {{Form::text('name',null,['class'=>'form-control col-5' , 'placeholder'=>"Enter Module"])}}
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
