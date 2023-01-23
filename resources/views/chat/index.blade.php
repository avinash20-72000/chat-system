@extends('chat.layouts.master')
@section('chat-content')
    {{-- user lists body --}}
    <div class="chat-body">
        <div class="search-user">
            {{Form::text('search',null,['class'=>'search', 'id'=>'user_name', 'placeholder'=>'Search...'])}}
            <span class="search_btn"><i class="fas fa-search"></i></span>
        </div>
        <div class="chat">
            <div class="contact-card">
                @include('chat.userList')
            </div>
        </div>
    </div>

    {{-- message box --}}

    <div class="message-body">
        @if (request()->id)
            @include('chat.message')
        @endif
    </div>
@endsection
