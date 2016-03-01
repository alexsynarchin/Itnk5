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
                <h1>{{$document_type}}</h1>
                <div class="box-body">
                    <div class="control-bnts row">
                        <div class="col-xs-4">
                            <a class="add-btn btn btn-primary" href="{{action('DocumentController@create', $document_type)}}"><i class="fa fa-plus-square-o"></i> Создать документ ввода остатков</a>
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
                                        <a href="{{action('DocumentController@show', [$document->id])}}"><i class="fa fa-eye"></i></a>
                                        <a href="{{action('DocumentController@edit',array($document->id))}}"><i class="fa fa-pencil-square-o"></i> </a>
                                        <a  href="{{URL::route('document.delete', array('id'=>$document->id))}}"><i class="fa fa-trash"></i></a>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div><!-- /.box-body -->
            </div>
        </section><!-- /.content -->
    </section><!-- /.content -->
@stop


