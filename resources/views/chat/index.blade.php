@extends('chat.layouts.master')
@section('chat-content')
    <div class="col-md-4 col-xl-3 chat">
        <div class="card mb-sm-3 mb-md-0 contacts_card">
            <div class="card-header">
                <div class="input-group">
                    <input type="text" placeholder="Search..." name="" id="user_name" class="form-control search">
                    <div class="input-group-prepend">
                        <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>

            @include('chat.userList')
            <div class="card-footer"></div>
        </div>
    </div>
    <div class="col-md-8 col-xl-6 chat">
        @if (request()->id)
            @include('chat.message')
        @endif
    </div>
@endsection
