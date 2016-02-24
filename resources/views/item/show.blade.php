@extends('layouts.dashboard')
@section('content')
    <section class="content-header">
        <h1>
            Просмотр данных основного средства
            <small>Система ИТНК-ОБЗОР</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Панель управления</a></li>
            <li class="active">Просмотр данных основного средства</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-info">
            <!-- form start -->
            <div class="box-body">
                <div class="os-show row">
                    <div class="col-xs-12">
                        <label>Наименование:</label>
                        <span>{{isset($item->name) ? $item->name : null}}</span>
                    </div>
                </div>
                <div class="os-show row">
                    <div class="col-xs-12">
                        <label>Инвертарный номер:</label>
                        <span>{{isset($item->number) ? $item->number : null}}</span>
                    </div>
                </div>
                <div class="os-show row">
                    <div class="col-xs-6">
                        <label>Источник финансирования:</label>
                        <span>{{isset($item->financing_source) ? App\Models\Item::$os_finance[$item->financing_source] : null}}</span>
                    </div>
                </div>
                @if(($document->os_type=='movables')||($document->os_type=='value_movables')||($document->os_type=='buildings')||($document->os_type=='car'))
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>ОКОФ:</label>
                            <span>{{isset($item->okof) ? $item->okof : null}}</span>
                        </div>
                    </div>
                @endif
                @if ($document->os_type=='buildings')
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Назначение:</label>
                            <span>{{isset($item->building->appointment) ? $item->building->appointment : null}}</span>
                        </div>

                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Этажность:</label>
                            <span>{{isset($item->building->floors) ? $item->building->floors : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Материал стен:</label>
                            <span>{{isset($item->building->wall_material) ? $item->building->wall_material : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Год постройки:</label>
                            <span>{{isset($item->building->date_construction) ? $item->building->date_construction : null}}</span>
                        </div>
                    </div>
                @endif
                @if ($document->os_type == 'parcels')
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Назначение земель:</label>
                            <span>{{isset($item->parcel->assigning_land) ? $item->parcel->assigning_land : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Кадастровый номер:</label>
                            <span>{{isset($item->parcel->cadastral) ? $item->parcel->cadastral : null }}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Площадь:</label>
                            <span>{{isset($item->parcel->area) ? $item->parcel->area : null }}</span>
                        </div>
                    </div>
                @endif
                @if (($document->os_type == "buildings") ||($document->os_type == "parcels"))
                    <h4>Адрес:</h4>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Регион:</label>
                            <span>{{isset($item->address->state) ? $item->address->state : null }}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Район:</label>
                            <span>{{isset($item->address->district) ? $item->address->district : null }}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Город / Населенный пункт:</label>
                            <span>{{isset($item->address->city) ? $item->address->city : null }}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Улица, дом, корпус:</label>
                            <span>{{isset($item->address->street) ? $item->address->street : null }}, {{isset($item->address->building_number) ? $item->address->building_number : null }}, {{isset($item->address->building_number_2) ? $item->address->building_number_2 : null }}</span>
                        </div>
                    </div>
                @endif
                @if ($document->os_type == 'car')
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Тип автомобиля:</label>
                            <span>{{isset($item->car->car_type) ? App\Models\Car::$car_type[$item->car->car_type] : null }}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Марка:</label>
                            <span>{{isset($item->car->brand) ? $item->car->brand : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Модель:</label>
                            <span>{{isset($item->car->model) ? $item->car->model : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Год выпуска:</label>
                            <span>{{isset($item->car->manufacture_year) ? $item->car->manufacture_year : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>VIN:</label>
                            <span>{{isset($item->car->vin) ? $item->car->vin : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>КПП:</label>
                            <span>{{isset($item->car->kpp) ? $item->car->kpp : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Двигатель:</label>
                            <span>{{isset($item->car->engine) ? $item->car->engine : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Мощность:</label>
                            <span>{{isset($item->car->power) ? $item->car->power : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Цвет:</label>
                            <span>{{isset($item->car->color) ? $item->car->color : null}}</span>
                        </div>
                    </div>
                @endif
                <div class="os-show row">
                    <div class="col-xs-12">
                        <label>Балансовая стоимость:</label>
                        <span>{{isset($item->carrying_amount) ? $item->carrying_amount : null }}</span>
                    </div>
                </div>
                <div class="os-show row">
                    <div class="col-xs-12">
                        <label>Дата принятия к учету:</label>
                        <span>{{isset($item->os_date) ? $item->os_date : null}}</span>
                    </div>
                </div>
                @if(($document->os_type=='movables')||($document->os_type=='value_movables')||($document->os_type=='buildings')||($document->os_type=='car'))
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Остаточная стоимость:</label>
                            <span>{{isset($item->variable->residual_value)? $item->variable->residual_value :null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Дата ввода в эксплуатацию:</label>
                            <span>{{isset($item->variable->exploitation_date) ? $item->variable->exploitation_date : null }}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Месячная норма:</label>
                            <span>{{isset($item->variable->monthly_rate) ? $item->variable->monthly_rate : null}}</span>
                        </div>
                    </div>
                    <div class="os-show row">
                        <div class="col-xs-12">
                            <label>Срок полезного использования:</label>
                            <span>{{isset($item->variable->useful_life) ? $item->variable->useful_life : null}}</span>
                        </div>
                    </div>
                @endif
            </div><!-- /.box-body -->
            <div class="box-footer center">
                <a href="{{action('DocumentController@show',[$item->document_id])}}" class="btn btn-primary">ЗАКРЫТЬ</a>
            </div><!-- /.box-footer -->
            {!!  Form::close() !!}
        </div>
    </section>
@stop