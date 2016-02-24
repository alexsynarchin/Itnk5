@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Профиль пользователя
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Профиль</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4>Основная информация:</h4>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Имя:</label>
                        </div>
                        <div class="col-xs-8">
                            {{$user->first_name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Фамилия:</label>
                        </div>
                        <div class="col-xs-8">
                            {{$user->last_name}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Отчество:</label>
                        </div>
                        <div class="col-xs-8">
                            {{$user->surname}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
@stop