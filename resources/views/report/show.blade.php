@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            @if(Auth::user() -> username == '1-0275071849')
                {{$report->organization->full_name}}
            @else
                Отчет - за  {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г
                <small>Система ИТНК-ОБЗОР</small>
            @endif
        </h1>
        @if(Auth::user() -> username == '1-0275071849')
            <h4>Отчет - за  {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г</h4>
        @endif
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Отчеты</li>
        </ol>
    </section>
    <section class="content">
        @include('report.partials.report_navigation')
        <div class="report-box box box-default">
            <div class="box-header with-border">
                @if(Auth::user() -> username == '1-0275071849')
                    <form method="post" class="inline" action="{{action('ReportController@postReportStateAccepted', [$report->id])}}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="add-btn btn btn btn-success">ПРИНЯТЬ ОТЧЕТ</button></form>
                    <form method="post" class="inline" action="{{action('ReportController@postReportStateNotAccepted', [$report->id])}}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="add-btn btn btn btn-danger">ОТКЛОНИТЬ ОТЧЕТ</button></form>
                @else
                    <form method="post" class="inline" action="{{action('ReportController@postReportStateInspection', [$report->id])}}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="add-btn btn btn btn-success">Отправить на проверку</button></form>
                @endif
                <form method="post" class="inline" action="{{action('InspectorController@postReportExcel')}}">
                    <input type="hidden" name="report_id" value="{{$report->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="btn btn-primary">Печатные формы</button>
                </form>
                <form method="post" class="inline" action="{{action('ReportController@postCalcReport', [$report->id])}}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="add-btn btn btn btn-primary">Рассчитать итоговые суммы по отчету</button></form>
                <div class="box-tools pull-right">
                    <span id="reportState-{{$report->state}}" class="label">{{App\Models\Report::$report_state[$report->state]}}</span>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <h4>Итоговые суммы по отчету</h4>
                <table class="list table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Балансовая стоимость</th>
                        <th>Начисленный износ</th>
                        <th>Сумма списания</th>
                        <th>Остаточная стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{number_format($report->report_total_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_wearout_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->decommission_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_total_residual_value, 2,'.', ' ') }}</td>
                    </tr>
                    </tbody>
                </table>
                <h4>Сводные данные по приобретению</h4>
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
                        <td>Остаточная стоимость</td>
                        <td>{{number_format($report->report_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_movables_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_value_movables_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_buildings_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_parcels_residual_value, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->report_cars_residual_value, 2,'.', ' ') }}</td>
                    </tr>
                    </tbody>
                </table>
                <h4>Сводные данные по начислению износа</h4>
                <table class="list table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>Балансовая стоимость</td>
                        <td>Начисление износа</td>
                        <td>Остаточная стоимость</td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{number_format($report->report_wearout_carrying_amount, 2,'.', ' ') }}</td>
                            <td>{{number_format($report->report_wearout_value, 2,'.', ' ') }}</td>
                            <td>{{number_format($report->report_wearout_residual_value, 2,'.', ' ') }}</td>
                        </tr>
                    </tbody>
                </table>
                <h4>Сводные данные по списанию основных средств</h4>
                <table class="list table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>Балансовая стоимость</td>
                        <td>Сумма списания</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{number_format($report->decommission_carrying_amount, 2,'.', ' ') }}</td>
                        <td>{{number_format($report->decommission_sum, 2,'.', ' ') }}</td>
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