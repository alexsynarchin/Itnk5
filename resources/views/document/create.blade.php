@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Новый документ ввода остатков
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Новый документ ввода остатков</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Документ первичного ввода</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            {!!  Form::open(array('action'=> 'DocumentController@store', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal'))!!}
            <div class="box-body">
                <div class="form-group">
                    <div class="os-form-group col-md-4 col-md-offset-1 col-xs-4 col-xs-offset-1">
                        <label for="document_date" class="control-label">Дата документа</label>
                        <div class="input-container">
                            <input type="date" required="required"  name="document_date" class="form-control">
                        </div>
                    </div>
                    <div class="os-form-group col-md-5 col-xs-5">
                        <label for="actual_date" class="control-label">Дата актуализации остатков</label>
                        <div class="input-container">
                            <input type="date" name="actual_date" required="required"  class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="os-form-group col-md-offset-3 col-xs-offset-2 col-md-6 col-xs-8">
                        <label class="control-label">Выберите тип основных средств</label>
                        <div class="input-container">
                            {!!   Form::select('os_type', App\Models\Document::$os_types, null, array('class' => 'form-control'))!!}
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