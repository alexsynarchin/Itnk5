@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Основные средства
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Основные средства</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box ">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-file-text-o"></i> Основные средства</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <table class="table table-bordered" id="items-table">
                            <thead>
                            <tr>
                                <th>Инвертарный номер</th>
                                <th>Наименование</th>
                                <th>Код ОКОФ</th>
                                <th>Балансовая стоимость</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>

    </section><!-- /.content -->

@stop
@section('user-scripts')
    <script>
        $(function() {
            $('#items-table').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                    "thousands": ","
                },
                processing: true,
                serverSide: true,
                searchable:true,
                ajax:
                {
                    url:'{!! route('items.data') !!}',
                    data:{
                        'id':"{{Auth::user()->id}}"
                    }

                },
                columns: [
                    { data: 'number', name: 'number' },
                    { data: 'name', name: 'name' },
                    {data: 'okof', name: 'okof' },
                    {data:'carrying_amount', name:'carrying_amount'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });
        });
    </script>
@stop


