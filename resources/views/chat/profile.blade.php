@extends('chat.layouts.master')

@section('chat-link')
    <link rel="stylesheet" href="{{ url('css/profile.css') }}" crossorigin="anonymous">
@endsection
@section('chat-content')
    <div class="profile">
        <h4 class="logo">Edit Profile</h4>
        {{ Form::model($user, ['method' => $method, 'route' => $submitRoute]) }}
        {{ Form::hidden('id',$user->id)}}
        <div class="profile-body">
            <div id="profile-section">
                <img src="{{ $user->getImagePath() }}" class="rounded-circle">

            </div>

            <div class="profile-data">
                <a href="{{ route('chatUsers') }}"><i class="fa fa-arrow-left"></i> Back to Chat</a>

                <div class="profile-data-input">
                    {{ Form::text('name', $user->name ?? null, ['placeholder' => 'Name']) }}
                    {{ Form::email('email', $user->email ?? null, ['placeholder' => 'E-mail']) }}
                    {{ Form::number('age', $user->age ?? null, ['placeholder' => 'Age']) }}

                    <div id="checkBox-field">
                        {!! Form::radio('gender', 'Male', !empty($user->gender) && $user->gender == 'Male' ? 1 : null) !!}
                        {{ Form::label('male', 'Male') }}
                        {!! Form::radio('gender', 'Female', !empty($user->gender) && $user->gender == 'Female' ? 1 : null) !!}
                        {{ Form::label('female', 'Female') }}
                    </div>
                    {{ Form::textarea('bio', null, ['id' => 'bio', 'placeholder' => 'Type your bio...']) }}

                    <div  id="save-profile">
                        <button type="submit"> Submit </button>
                    </div>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
