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
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Организации</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered" id="organizations-table">
                    <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>ИНН</th>
                        <th>Балансовая стоимость</th>
                        <th>Остаточная стоимость</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                </table>
            </div><!-- /.box-body -->
            <div class="box-footer">

            </div><!-- box-footer -->
        </div><!-- /.box -->
    </section>
@stop
@section('user-scripts')
    <script>
        $(function() {
            $('#organizations-table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                    "thousands": ","
                },
                processing: true,
                serverSide: true,
                searchable:true,
                ajax:
                {
                    url:'{!! route('inspector.organizations') !!}'
                },
                columns: [
                    { data: 'short_name', name: 'short_name' },
                    { data: 'inn', name: 'inn' },
                    { data: 'org_carrying_amount', name: 'org_carrying_amount' },
                    { data: 'org_residual_value', name: 'org_residual_value' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}


                ]
            });
        });
    </script>
@stop