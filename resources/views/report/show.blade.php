@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Отчет - за  {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Отчеты</li>
        </ol>
    </section>
    <section class="content">
        @include('report.partials.report_navigation')
        <div class="report-box box box-default">
            <div class="box-header with-border">
                <a href="" class="btn btn-success btn-lg">Отправить на проверку</a>
                <a href="" class="btn btn-primary btn-lg">Печатные формы</a>
                <div class="box-tools pull-right">
                    <span id="reportState-{{$report->state}}" class="label">{{App\Models\Report::$report_state[$report->state]}}</span>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
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
    </section>
@stop
@section('user-scripts')
    <script type="text/javascript">
        var acceptedReport = document.getElementById('reportState-accepted');
        var not_acceptedReport = document.getElementById('reportState-not_accepted');
        var inspectionReport = document.getElementById('reportState-inspection');
        if (acceptedReport != null){
            acceptedReport.classList.add('label-success');
        }
        if (not_acceptedReport != null){
            not_acceptedReport.classList.add('label-danger');
        }
        if (inspectionReport != null) {
            inspectionReport.classList.add('label-warning');
        }
    </script>
@stop