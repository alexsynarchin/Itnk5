@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
                Документ  {{$document_title}} № {{$document -> document_number}}
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Документ  {{$document_title}} № {{$document -> document_number}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="document box">
            <div class="box-header with-border">
                <div class="form-group">
                    <div class="os-form-group col-xs-3">
                        <label class="control-label">Дата документа:</label><span class="date">{{$document->document_date}}</span>
                    </div>
                    <div class="os-form-group col-xs-4">
                        <label class="control-label">Дата актуализации остатков:</label><span class="date">{{$document->actual_date}}</span>
                    </div>
                    <div class="col-xs-3"><a href="{{action('DocumentController@edit',array($document->id))}}" class="edit-btn btn btn-warning">Редактировать документ</a> </div>
                </div>

                <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <span class="label label-danger">Черновик</span>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts row">
                    <div class="col-xs-8">
                        <a href="{{route('item.create', [$document->id])}}" class="add-btn btn btn-primary"><i class="fa fa-plus-square-o"></i> Добавить основное средство</a>
                        <form method="post" class="inline" action="{{action('DocumentController@postDocSave', [$document->id])}}"><input type="hidden" name="_token" value="{{ csrf_token() }}"><button type="submit" class="add-btn btn btn-success">Сохранить документ</button></form>
                        @if($document->document_type == 'purchase')
                        <a href="{{action('ReportController@purchase',$document->report_id)}}" class="add-btn btn btn-danger"><i class="fa fa-plus-square-o"></i> Закрыть документ</a>
                        @elseif($document->document_type == 'residues_entering')
                            <a href="{{action('DocumentController@residues_entering')}}" class="add-btn btn btn-danger"><i class="fa fa-plus-square-o"></i> Закрыть документ</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <form action="{{action('DocumentController@postImport',[$document->id])}}" method="post" class="form-horizontal col-xs-12" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary">Импортировать</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="document_sum">
                    <label>Сумма по балансовой стоимости:</label> <span>{{$document->doc_carrying_amount}}</span><br>
                    <label>Сумма по остаточной стоимости:</label> <span>{{$document->doc_residual_value}}</span>
                </div>
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
            <div class="box-footer">

            </div><!-- box-footer -->
        </div><!-- /.box -->
    </section>
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
                url:'{!! route('document.items') !!}',
                data:{
                    'document_id':"{{$document->id}}"
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