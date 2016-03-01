@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
         Ввод основного средства
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Ввод основного средства</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <!-- form start -->
            {!!  Form::open(array('url' => action('ItemController@store', [$document->id]), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) !!}
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