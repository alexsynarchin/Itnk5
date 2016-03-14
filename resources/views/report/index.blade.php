@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Отчеты
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Отчеты</li>
        </ol>
    </section>
    <section class="content">
        @foreach($reports as $report)
        <div class="report-box box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Учетный период - {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г.</h3>
                <div class="box-tools pull-right">
                    <span class="label label-primary">{{App\Models\Report::$report_state[$report->state]}}</span>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts row">
                    <a href="" class="add-btn btn btn-success"><i class="fa fa-sign-in"></i> Перейти к отчету</a>
                    <a href="" class="add-btn btn btn-primary"><i class="fa fa-print"></i> Печать</a>
                </div>
                <table class="list table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Итого</th>
                            <th>Движимое имущество</th>
                            <th>Особо ценное движимое имущество</th>
                            <th>Здания и сооружения</th>
                            <th>Земельные участки</th>
                            <th>Автомобили</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Балансовая стоимость</td>
                        <td>{{number_format($report->report_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_movables_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_value_movables_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_buildings_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_parcels_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_cars_carrying_amount, 2,'.', ' ') }}</td>
                    </tr>
                    <tr>
                        <td>Начисленный износ</td>
                        <td>{{number_format($report->report_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_movables_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_value_movables_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_buildings_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_parcels_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_cars_residual_value, 2,'.', ' ') }}</td>
                    </tr>
                    <tr>
                        <td>Остаточная стоимость</td>
                        <td>{{number_format($report->report_wearout_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_movables_wearout_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_value_movables_wearout_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_buildings_wearout_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_parcels_wearout_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_cars_wearout_value, 2,'.', ' ') }}</td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        @endforeach
    </section>
@stop