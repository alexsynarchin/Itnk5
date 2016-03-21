@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
           Документ {{$document_title}} № {{$document -> document_number}}
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Документ {{$document_title}} № {{$document -> document_number}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            {!! Form::model($document, array('url' => action('DocumentController@update', $document->id), 'method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal')) !!}
            <div class="box-body">
                <div class="form-group">
                    <div class="os-form-group col-md-4 col-md-offset-1 col-xs-4 col-xs-offset-1">
                        <label for="document_date" class="control-label">Дата документа</label>
                        <div class="input-container">
                            <input type="date" value="{{$document->document_date}}" name="document_date" class="form-control">
                        </div>
                    </div>
                    <div class="os-form-group col-md-5 col-xs-5">
                        <label for="actual_date" class="control-label">Дата актуализации остатков</label>
                        <div class="input-container">
                            <input type="date" name="actual_date" value="{{$document->actual_date}}" class="form-control">
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Сохранить документ</button>
            </div><!-- /.box-footer -->
            {!!  Form::close() !!}
        </div>

    </section>
@stop