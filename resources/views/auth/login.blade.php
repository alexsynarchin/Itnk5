<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.landing_partials.head')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class=" auth-panel panel panel-default">
                <div class="panel-heading center">Форма авторизации</div>
                @foreach($errors -> all() as $error)
                    <p class="alert alert-danger">{!!$error!!}</p>
                @endforeach
                <div class="panel-body">
                    <form class="auth-form form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Логин</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="username" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Пароль</label>
                            <div class="col-md-7">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="center ">
                                <button type="submit" class="btn btn-default ">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer_padding"></div>
<footer>
    @include('layouts.landing_partials.footer')
</footer>
</body>
</html>