@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Организация - {{$organization -> short_name}}
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="control-bnts row">
            <div class=" right col-xs-6 col-xs-offset-6">
                <a href="{{URL::previous()}}" class="big add-btn btn btn-danger">Закрыть</a>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="list table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Итоговые суммы</th>
                        <th>
                            Движимое имущество
                        </th>
                        <th>
                            Особо ценное движимое имущество
                        </th>
                        <th>
                            Здания и сооружения
                        </th>
                        <th>Земельные участки</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Балансовая стоимость</td>
                        <td>{{number_format($organization->org_carrying_amount, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_movables_carrying_amount, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_value_movables_carrying_amount, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_buildings_carrying_amount, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_parcels_carrying_amount, 2,'.', ' ')}}</td>
                    </tr>
                    <tr>
                        <td>Остаточная стоимость</td>
                        <td>{{number_format($organization->org_residual_value, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_movables_residual_value, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_value_movables_residual_value, 2,'.', ' ')}}</td>
                        <td>{{number_format($organization->org_buildings_residual_value, 2,'.', ' ')}}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="document box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Документы первичного ввода</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
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
                    </tr>
                    </thead>
                    <tbody>
                    @if($documents->count())
                        @foreach($documents as $document)
                            <tr>
                                <td>{{$document->document_number}}</td>
                                <td>{{ App\Models\Document::$os_types[$document->os_type] }}</td>
                                <td>{{$document->document_date}}</td>
                                <td>{{$document->actual_date}}</td>
                                <td>{{number_format($document->doc_carrying_amount, 2,'.', ' ')}}</td>
                                <td>{{number_format($document->doc_residual_value, 2,'.', ' ')}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody></table>
            </div><!-- /.box-body -->
        </div>
    </section><!-- /.content -->
@stop