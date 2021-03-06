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
        <div class="box">
            <div class="box-header with-border">
                <form method="post" class="form-horizontal" action="{{action('InspectorController@postOrganizationExcel')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Выберите год:</label>
                            {!!  Form::select('year', [2015=>'2015', 2016=>'2016'], 2015)!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <h5>Выберите учетные периоды:</h5>
                            {!! Form::label('1 квартал') !!} {!! Form::checkbox('quarters[1]', 1, true) !!}
                            {!! Form::label('2 квартал') !!} {!! Form::checkbox('quarters[2]', 2, true) !!}
                            {!! Form::label('3 квартал') !!} {!! Form::checkbox('quarters[3]', 3, true) !!}
                            {!! Form::label('4 квартал') !!} {!! Form::checkbox('quarters[4]', 4, true) !!}
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Сводный отчет</button>
                </form>
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
                "search": {
                    "caseInsensitive": false
                },
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                    "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",

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