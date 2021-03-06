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
            <div class="report-box box">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <a href="" class="btn btn-success btn-lg">Отправить на проверку</a>
                        <div class="box-tools pull-right">
                            @if(isset($residue->state))
                                <span id="reportState-{{$residue->state}}" class="label">{{App\Models\Residue::$residual_entering_state[$residue->state]}}</span>
                            @endif
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                </div><!-- /.box-header -->
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
                                    <td>{{$document->document_date}}</td>
                                    <td>{{$document->actual_date}}</td>
                                    <td>{{number_format($document->doc_carrying_amount, 2,'.', ' ')}}</td>
                                    <td>{{number_format($document->doc_residual_value, 2,'.', ' ')}}</td>
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
@section('user-scripts')
    <script type="text/javascript">
        var acceptedReport = document.getElementById('reportState-accepted');
        var not_acceptedReport = document.getElementById('reportState-not_accepted');
        var inspectionReport = document.getElementById('reportState-inspection');
        if (acceptedReport != null){
            acceptedReport.classList.add('label-success');
        }
        if (not_acceptedReport != null){
            not_acceptedReport.classList.add('label-danger');
        }
        if (inspectionReport != null) {
            inspectionReport.classList.add('label-warning');
        }
    </script>
@stop


