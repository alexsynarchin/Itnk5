@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Списание ОС  отчет - за  {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Отчеты</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <!-- form start -->
            {!!  Form::model($decommission, array('url' => action('DecommissionController@update', [$decommission->id]), 'method' => 'patch', 'role' => 'form', 'class' => 'form-horizontal')) !!}
            <div class="box-body">
                @include('report.decommission.form')
            </div><!-- /.box-body -->
            <div class="box-footer center">
                <button type="submit" class="btn btn-success">СОХРАНИТЬ</button> <a href="{{URL::previous()}}" class="btn btn-primary">ЗАКРЫТЬ БЕЗ СОХРАНЕНИЯ</a>
            </div><!-- /.box-footer -->
            {!!  Form::close() !!}
        </div>
    </section>
@stop