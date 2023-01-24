<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/registerlogin.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="{{ csrf_token() }}">
    <title>Chat | System</title>
</head>

<body>
    <div class="main">
            {{ Form::open(['method' => 'POST', 'route' => 'password.update', 'class' => 'reset-password']) }}
            <h2>Reset Password</h2>
            <input type="hidden" name="token" value="{{ $token }}">
            {{ Form::email('email', $email ?? old('email'), ['placeholder' => 'E-mail', 'required']) }}
            {{ Form::password('password', ["class"=>"form-control",'placeholder' => 'New Password', "id"=>"password"]) }}
            {{ Form::password('password_confirmation', ["class"=>"form-control",'placeholder' => 'Password Confirm', "id"=>"password-confirm", "required"]) }}
            @error('password')
                <span class="invalid-feedback" role="alert" style="color:red;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit"> {{ __('Reset') }}</button>
            {{ Form::close() }}

    </div>
</body>
</html>

