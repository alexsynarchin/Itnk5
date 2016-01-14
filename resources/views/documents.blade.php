@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Документы
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Документы</li>
        </ol>
    </section>
    <section class="content">
       @include('documents.documents_partials.documents_navigation')
        <div class="document box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-file-text-o"></i> Документы <span class="label bg-aqua">4 квартал 2015 года</span></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="list table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>
                            Раздел учета ОС
                        </th>
                        <th>
                            Вид документа
                        </th>
                        <th>
                            Балансовая стоимость
                        </th>
                        <th>Остаточная стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Автомобили</td>
                        <td>Начисление износа</td>
                        <td>12 000 000</td>
                        <td>10 000 000</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Движимое имущество</td>
                        <td>Начисление износа</td>
                        <td>1 200 370</td>
                        <td>602 300</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Особо ценное движимое имущество</td>
                        <td>Начисление износа</td>
                        <td>3 000 000</td>
                        <td>2 200 000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Здания и сооружения</td>
                        <td>Начисление износа</td>
                        <td>12 000 000</td>
                        <td>10 000 000</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Особо ценное движимое имущество</td>
                        <td>Приобретение</td>
                        <td>3 000 000</td>
                        <td>2 200 000</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Здания и сооружения</td>
                        <td>Начисление износа</td>
                        <td>12 000 000</td>
                        <td>10 000 000</td>
                    </tr>
                    </tbody>
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