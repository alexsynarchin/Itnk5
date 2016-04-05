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
            <h3>Отчет - за  {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г</h3>
        @endif
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Отчеты</li>
        </ol>
    </section>
    <section class="content">
        @include('report.partials.report_navigation')
        <div class="document box">
            <div class="box-header with-border">
                <h3 class="box-title">  </h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts row">
                    @if(Auth::user() -> username != '1-0275071849')
                        <div class="control-bnts">
                            <div class="row">

                                <form action="{{action('DecommissionController@postImport',[$report->id])}}" method="post" class="form-horizontal col-xs-12" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <div class="col-xs-10">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-primary">Импортировать список списанных ОС </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <a href="{{route('decommission.create', [$report->id])}}" class="add-btn btn btn-primary"><i class="fa fa-plus-square-o"></i> Ввести данные о списании Основного средства</a>
                            <form method="post" class="inline" action="{{action('DecommissionController@postDeleteAll', [$report->id])}}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="add-btn btn btn btn-danger">Удалить все данные по списанию для отчета</button></form>
                        </div>
                    @endif
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <table class="table table-bordered" id="decommission-table">
                    <thead>
                    <tr>
                        <th>Инвертарный номер</th>
                        <th>Наименование</th>
                        <th>Сумма списания</th>
                        <th>Дата списания</th>
                        <th>Вид списания</th>
                        @if(Auth::user() -> username != '1-0275071849')
                            <th>Действия</th>
                        @endif
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    @stop
    @section('user-scripts')
            <!-- page script -->
    @if(Auth::user() -> username == '1-0275071849')
        <script>
            $(function() {
                $('#decommission-table').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                        "thousands": ","
                    },
                    processing: true,
                    serverSide: true,
                    searchable:true,
                    ajax:
                    {
                        url:'{!! route('report.decommission.items') !!}',
                        data:{
                            'report_id':"{{$report->id}}"
                        }

                    },
                    columns: [
                        { data: 'number', name: 'number' },
                        { data: 'name', name: 'name' },
                        {data:'sum', name:'sum'},
                        {data:'date',name:'date'},
                        {data:'decommission_type', name:'decommission_type'}
                    ]
                });
            });
        </script>
    @else
        <script>
            $(function() {
                $('#decommission-table').DataTable({
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                        "thousands": ","
                    },
                    processing: true,
                    serverSide: true,
                    searchable:true,
                    ajax:
                    {
                        url:'{!! route('report.decommission.items') !!}',
                        data:{
                            'report_id':"{{$report->id}}"
                        }

                    },
                    columns: [
                        { data: 'number', name: 'number' },
                        { data: 'name', name: 'name' },
                        {data:'sum', name:'sum'},
                        {data:'date',name:'date'},
                        {data:'decommission_type', name:'decommission_type'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}

                    ]
                });
            });
        </script>
    @endif
    @stop