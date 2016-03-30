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
                <h3 class="box-title">Начисление износа</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts">
                    <div class="row">
                        <form action="" method="post" class="form-horizontal col-xs-12" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <input type="file" name="file" class="form-control">
                                </div>
                                <div class="col-xs-2">
                                    <button type="submit" class="btn btn-primary">НАЧИСЛИТЬ ИЗНОС </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <a href="{{route('depreciation.create', [$report->id])}}" class="add-btn btn btn-primary"><i class="fa fa-plus-square-o"></i> Начислить износ основному средству</a>
                </div>
                <table class="table table-bordered" id="depreciations-table">
                    <thead>
                    <tr>
                        <th>Инвертарный номер</th>
                        <th>Наименование</th>
                        <th>Балансовая стоимость</th>
                        <th>Начисленный износ</th>
                        <th>Остаточная стоимость</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
@stop
@section('user-scripts')
    <script>
        $(function() {
            $('#depreciations-table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                    "thousands": ","
                },
                processing: true,
                serverSide: true,
                searchable:true,
                ajax:
                {
                    url:'{!! route('report.depreciation.items') !!}',
                    data:{
                        'report_id':"{{$report->id}}"
                    }

                },
                columns: [
                    { data: 'number', name: 'number' },
                    { data: 'name', name: 'name' },
                    {data:'carrying_amount', name:'carrying_amount'},
                    {data:'sum', name:'sum'},
                    {data:'residual_value', name:'residual_value'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });
    </script>
@stop