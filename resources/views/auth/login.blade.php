<!DOCTYPE html>
<html>

<head>
    <title>Chat | User</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css\login.css')}}">
    <meta name="token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            {{ Form::open(['method' => 'POST', 'route' => 'register']) }}
            <label for="chk" aria-hidden="true">Sign up</label>
            {{ Form::text('name', null, ['placeholder' => 'User Name', 'required']) }}
            {{ Form::email('email', null, ['placeholder' => 'E-mail', 'required']) }}
            {{ Form::password('password', ['placeholder' => 'Password']) }}
            {{ Form::password('password_confirmation', ['placeholder' => 'Password Confirm']) }}
            <button id="register-button" type="submit"> {{ __('Register') }}</button>
            {{ Form::close() }}
        </div>

        <div class="login">
            {{ Form::open(['method' => 'POST', 'route' => 'login']) }}
            <label for="chk" aria-hidden="true">Login</label>
            {{ Form::email('email', null, ['placeholder' => 'E-mail', 'required']) }}
            {{ Form::password('password', ['placeholder' => 'Password']) }}
            <button id="login-button" type="submit">{{ __('Login') }}</button>
            {{ Form::close() }}
        </div>
    </div>
</body>

</html>
