@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Ввод остатков
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="documents"><i class="fa fa-dashboard"></i> Документы</a></li>
            <li class="active">Ввод остатков</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main content -->
        <section class="content">
            <div class="document box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-file-text-o"></i> Документы ввода остатков</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="control-bnts row">
                        <div class="col-xs-4">
                            <a class="add-btn btn btn-primary" href="/documents/add"><i class="fa fa-plus-square-o"></i> Создать документ ввода остатков</a>
                        </div>
                    </div>
                    <table class="list table table-bordered table-hover">
                        <tbody>
                        <thead>
                            <th>Номер</th>
                            <th>
                                Вид Основных средств
                            </th>
                            <th>
                                Дата документа
                            </th>
                            <th>
                                Дата актуализации остатков
                            </th>
                            <th>Действия</th>
                        </thead>
                        @if($documents->count())
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{$document->id}}</td>
                                    <td>{{ App\Models\Document::$os_types[$document->os_type] }}</td>
                                    <td>{{$document->document_date}}</td>
                                    <td>{{$document->actual_date}}</td>
                                    <td class="actions icons">

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody></table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="#">«</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </section><!-- /.content -->

    </section><!-- /.content -->

@stop


