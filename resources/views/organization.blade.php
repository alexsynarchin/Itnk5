@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Организация
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Организация</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <h4>{{$organization -> full_name}}</h4>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-2"><label>ИНН:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> inn}}
                    </div>
                    <div class="col-xs-2"><label>КПП:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> kpp}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2"><label>Фактический адрес:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> fact_address}}
                    </div>
                    <div class="col-xs-2"><label>Юридический адрес:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> legal_address}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2"><label>ФИО руководителя:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> fio}}
                    </div>
                    <div class="col-xs-2"><label>Должность руководителя:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> boss_position}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2"><label>На основании чего действует (для договора):</label></div>
                    <div class="col-xs-4">
                        {{$organization -> operate_foundation}}
                    </div>
                    <div class="col-xs-2"><label>В Банке:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> bank}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2"><label>РС:</label></div>
                    <div class="col-xs-4">
                        {{$organization ->  rs}}
                    </div>
                    <div class="col-xs-2"><label>КС:</label></div>
                    <div class="col-xs-4">
                        {{$organization -> ks}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2"><label>БИК:</label></div>
                    <div class="col-xs-4">
                        {{$organization ->  bik}}
                    </div>
                    <div class="col-xs-2"><label>Ф.И.О. Ответственного сотрудника:</label></div>
                    <div class="col-xs-4">
                        {{Auth::user()-> last_name }} {{Auth::user()-> first_name }}  {{Auth::user()-> surname }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2"><label>Телефон:</label></div>
                    <div class="col-xs-4">
                        {{$organization ->  phone}}
                    </div>
                    <div class="col-xs-2"><label>EMAIL:</label></div>
                    <div class="col-xs-4">
                        {{$organization ->  email}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop