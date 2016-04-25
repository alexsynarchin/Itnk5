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
            <h4>Отчет - за  {{App\Models\Report::$report_quarter[$report->quarter]}} квартал {{$report->year}} г</h4>
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
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Документы приобретения</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                @if(Auth::user() -> username != '1-0275071849')
                <div class="control-bnts row">
                    <div class="col-xs-4">
                        <a class="add-btn btn btn-primary" href="{{action('DocumentController@reportCreate',[$report->id, $document_type])}}"><i class="fa fa-plus-square-o"></i> Создать документ приобретения</a>
                    </div>
                </div>
                @endif
                <table class="list table table-bordered table-hover">
                    <tbody>
                    <thead>
                    <th>Номер</th>
                    <th>
                        Вид Основных средств
                    </th>
                    <th>
                        Балансовая стоимость
                    </th>
                    <th>
                        Остаточная стоимость
                    </th>
                    <th>Действия</th>
                    </thead>
                    @if($documents->count())
                        @foreach($documents as $document)
                            <tr>
                                <td>{{$document->id}}</td>
                                <td>{{ App\Models\Document::$os_types[$document->os_type] }}</td>
                                <td>{{number_format($document->doc_carrying_amount, 2,'.', ' ')}}</td>
                                <td>{{number_format($document->doc_residual_value, 2,'.', ' ')}}</td>
                                <td class="actions icons">
                                    <a href="{{action('DocumentController@show', [$document->id])}}"><i class="fa fa-eye"></i></a>
                                    @if(Auth::user() -> username != '1-0275071849')
                                    <a href="{{action('DocumentController@edit',array($document->id))}}"><i class="fa fa-pencil-square-o"></i> </a>
                                    <a  href="{{URL::route('document.delete', array('id'=>$document->id))}}"><i class="fa fa-trash"></i></a>
                                    @endif
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