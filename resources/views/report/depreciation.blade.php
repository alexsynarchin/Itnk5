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
        <div class="document box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts row">

                </div>

            </div><!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
    @stop
    @section('user-scripts')
            <!-- page script -->

@stop