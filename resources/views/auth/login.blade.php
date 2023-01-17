<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/registerlogin.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="token" content="{{ csrf_token() }}">
    <title>Chat | System</title>
</head>

<body>
    <div class="main">
        <div class="form-content ">
            {{-- signup --}}
            {{ Form::open(['method' => 'POST', 'route' => 'register', 'class' => 'signup']) }}
            <h2>Sign up</h2>
            {{ Form::text('name', null, ['placeholder' => 'User Name', 'required']) }}
            {{ Form::email('email', null, ['placeholder' => 'E-mail', 'required']) }}
            {{ Form::password('password', ['placeholder' => 'Password']) }}
            {{ Form::password('password_confirmation', ['placeholder' => 'Password Confirm']) }}
            <button id="register-button" type="submit"> {{ __('Register') }}</button>
            {{ Form::close() }}

            {{-- login  --}}
            {{ Form::open(['method' => 'POST', 'route' => 'login', 'class' => 'login']) }}
            <h2>Login</h2>
            {{ Form::email('email', null, ['placeholder' => 'E-mail', 'required']) }}
            {{ Form::password('password', ['placeholder' => 'Password']) }}
            <button id="login-button" type="submit">{{ __('Login') }}</button>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            {{ Form::close() }}
        </div>
    </div>
</body>
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<script>

        $('.login h2').on('click',function(){
            $(this).parent().addClass('active');
        });

        $('.signup h2').on('click',function(){
            $('.login').removeClass('active');
        });

</script>
</html>
