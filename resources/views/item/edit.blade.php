@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Редактирование основного средства
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Редактирование основного средства</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <!-- form start -->
            {!!  Form::model($item, array('url' => action('ItemController@update',$item->id), 'method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal')) !!}
            <div class="box-body">
                @include('item.partials.form')
            </div><!-- /.box-body -->
            <div class="box-footer center">
                <button type="submit" class="btn btn-success">СОХРАНИТЬ ОСНОВНОЕ СРЕДСТВО</button> <a href="{{URL::previous()}}" class="btn btn-primary">ЗАКРЫТЬ БЕЗ СОХРАНЕНИЯ</a>
            </div><!-- /.box-footer -->
            {!!  Form::close() !!}
        </div>
    </section>
@stop