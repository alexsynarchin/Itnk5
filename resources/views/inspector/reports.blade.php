@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Инспектор
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active"> Инспектор</li>
        </ol>
    </section>
    <section class="content">
        @include('inspector.partials.inspector_navigation')
        @foreach($reports as $report)
            <div class="report-box  box box-primary">
                <div class="box-header with-border">
                    <h3>{{$report->organization->short_name}}</h3>
                    <h3 class="box-title">Учетный период - {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г.</h3>
                    <div class="box-tools pull-right">
                        <span  class="reportState-{{$report->state}} label">{{App\Models\Report::$report_state[$report->state]}}</span>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="control-bnts row">
                        <a href="{{route('report.show', [$report->id])}}" class="add-btn btn btn-success"><i class="fa fa-sign-in"></i> Перейти к отчету</a>
                    </div>
                    <table class="list table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Балансовая стоимость</th>
                            <th>Начисленный износ</th>
                            <th>Остаточная стоимость</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{number_format($report->report_total_carrying_amount, 2,'.', ' ') }}</td>
                            <td>{{number_format($report->report_wearout_value, 2,'.', ' ') }}</td>
                            <td>{{number_format($report->report_total_residual_value, 2,'.', ' ') }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        @endforeach
    </section>
@stop
@section('user-scripts')
    <script type="text/javascript">
        var acceptedReports = document.getElementsByClassName('reportState-accepted');
        var not_acceptedReports = document.getElementsByClassName('reportState-not_accepted');
        var inspectionReports = document.getElementsByClassName('reportState-inspection');
        for (var i = 0; i < acceptedReports.length; i++){
            acceptedReports[i].classList.add('label-success');
        }
        for (var i = 0; i < not_acceptedReports.length; i++){
            not_acceptedReports[i].classList.add('label-danger');
        }
        for (var i = 0; i < inspectionReports.length; i++){
            inspectionReports[i].classList.add('label-warning');
        }
    </script>
@stop