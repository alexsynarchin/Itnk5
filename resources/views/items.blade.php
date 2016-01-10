@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Основные средства
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Основные средства</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box ">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-file-text-o"></i> Основные средства</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body ">
                        <table class="table table-bordered table-hover dataTable" id="items-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>

    </section><!-- /.content -->

@stop


