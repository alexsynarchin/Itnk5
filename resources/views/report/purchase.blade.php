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
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Документы приобретения</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts row">
                    <div class="col-xs-4">
                        <a class="add-btn btn btn-primary" href="{{action('DocumentController@reportCreate',[$report->id, $document_type])}}"><i class="fa fa-plus-square-o"></i> Создать документ приобретения</a>
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
            <div class="box-footer clearfix">

            </div>
        </div>
    </section>
    @stop
    @section('user-scripts')
            <!-- page script -->

@stop