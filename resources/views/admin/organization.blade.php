@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Администрирование
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li><a href="/admin"> Администрирование</a></li>
            <li class="active">{{$organization->short_name}}</li>
        </ol>
    </section>
    <section class="content">
        <h1 class="organization-heading center">{{$organization->short_name}}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-file-text-o"></i> Отчеты</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="control-bnts row">
                            <div class="col-xs-4">
                                {!!  Form::open(array('url' => action('ReportController@store',[$organization->id]), 'method' => 'post', 'role' => 'form')) !!}
                                <button type="submit" class="add-btn btn btn-primary">СОЗДАТЬ ОТЧЕТ</button>
                                {!!  Form::close() !!}
                            </div>
                        </div>
                        <table class="table table-bordered" id="reports-table">
                            <thead>
                            <tr>
                                <th>Год</th>
                                <th>Квартал</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            @if($reports->count())
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{$report->year}}</td>
                                        <td>{{App\Models\Report::$report_quarter[$report->quarter]}}</td>
                                        <td>{{App\Models\Report::$report_state[$report->state]}}</td>
                                        <td>Действие</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-file-text-o"></i> Ввод остатков</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="control-bnts row">
                            <div class="col-xs-4">
                                {!!  Form::open(array('url' => action('AdminController@residueStore',[$organization->id]), 'method' => 'post', 'role' => 'form')) !!}
                                <button type="submit" class="add-btn btn btn-primary">СОЗДАТЬ ОТЧЕТ ВВОДА ОСТАТКОВ</button>
                                {!!  Form::close() !!}
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
        <div class="document box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Документы первичного ввода</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="control-bnts row">
                    <div class="col-xs-6">
                        <a class="add-btn btn btn-success" href="{{route('admin.document.create',[$organization->user->id])}}"><i class="fa fa-plus-square-o"></i> Создать документ первичного ввода</a> <form method="post" class="inline" action="{{action('OrganizationController@postCalcSumsFirstEnter', [$organization->id])}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="add-btn btn btn-primary">Обновить итоговые суммы по организации</button></form>
                    </div>
                </div>
                <table class="list table table-bordered table-hover">
                    <thead>
                    <tr>
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
                        <th>Балансовая стоимость</th>
                        <th>Остаточная стоимость</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($documents->count())
                        @foreach($documents as $document)
                            <tr>
                                <td>{{$document->document_number}}</td>
                                <td>{{ \App\Models\Document::$os_types[$document->os_type] }}</td>
                                <td>{{$document->document_date}}</td>
                                <td>{{$document->actual_date}}</td>
                                <td>{{number_format($document->doc_carrying_amount, 2,'.', ' ')}}</td>
                                <td>{{number_format($document->doc_residual_value, 2, '.', ' ')}}</td>
                                <td class="actions icons">
                                    <a href="{{route('admin.document.show',[$document->id])}}"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.document.edit',[$document->id])}}"><i class="fa fa-pencil-square-o"></i> </a>
                                    <a  href="{{route('document.delete',['id'=>$document->id])}}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody></table>
            </div><!-- /.box-body -->
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3>Договор</h3>
            </div>
            <div class="box-body">
                <div class="control-bnts row">
                    {!!  Form::open(array('url' => action('AdminController@postOrgDocUpload',[$organization->id]), 'method' => 'post', 'role' => 'form','files' => true)) !!}
                    <div class="form-group">
                        <input type="file" name="OrgDoc" id="OrgDoc">
                    </div>
                    <button  class="add-btn btn btn-primary" type="submit">Загрузить договор</button>
                    {!!  Form::close() !!}
                </div>
                <table class="list table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                Год
                            </th>
                            <th>
                                Название файла
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                        @if($orgdocs->count())
                            @foreach($orgdocs as $orgdoc)
                                <tr>
                                    <td>
                                        {{$orgdoc -> year}}
                                    </td>
                                    <td>
                                        {{$orgdoc -> original_filename}}
                                    </td>
                                    <td>
                                        <a href="{{route('download.orgdoc',[$orgdoc->id])}}">Скачать</a>
                                    </td>
                                    <td>
                                        <a  href="{{URL::route('orgdoc.delete',[$orgdoc->id])}}"><i class="fa fa-trash"></i> Удалить</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </thead>
                </table>
            </div>
        </div>
    </section>
@stop