@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Администрирование
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="/admin"> Администрирование</a></li>
            <li class="active">{{$organization->short_name}}</li>
        </ol>
    </section>
    <section class="content">
        <h1 class="organization-heading center">{{$organization->short_name}}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-file-text-o"></i> Отчеты</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="control-bnts row">
                            <div class="col-xs-4">
                                {!!  Form::open(array('url' => action('ReportController@store',[$organization->id]), 'method' => 'post', 'role' => 'form')) !!}
                                <button type="submit" class="add-btn btn btn-primary">СОЗДАТЬ ОТЧЕТ</button>
                                {!!  Form::close() !!}
                            </div>
                        </div>
                        <table class="table table-bordered" id="reports-table">
                            <thead>
                            <tr>
                                <th>Год</th>
                                <th>Квартал</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            @if($reports->count())
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{$report->year}}</td>
                                        <td>{{App\Models\Report::$report_quarter[$report->quarter]}}</td>
                                        <td>{{App\Models\Report::$report_state[$report->state]}}</td>
                                        <td>Действие</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@stop