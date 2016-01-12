<!DOCTYPE html>
<html>
<head>
    @include('layouts.partials_dashboard.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        ИТНК Обзор
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Введите ваши логин и пароль</p>
        @foreach($errors -> all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        <form action="{{ url('/auth/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="username" class="form-control" placeholder="Введите логин">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Введите пароль">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="center row">
                <!-- /.col -->
                    <button type="submit" class="btn btn-primary btn-flat">ВОЙТИ В СИСТЕМУ</button>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
</body>
</html>

