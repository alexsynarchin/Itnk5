<div class="form-group">
    <div class="os-form-group col-xs-6">
        <label for="car_type" class="control-label">Тип автомобиля:</label>
            {!! Form::select('car_type', App\Models\Car::$car_type, isset($item->car->car_type) ? $item->car->car_type : null, array('class' => 'form-control')) !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="brand" class="control-label">Марка:</label>
        <input required="required" type="text" name="brand" class="form-control" value="{{isset($item->car->brand) ? $item->car->brand : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="model" class="control-label">Модель:</label>
        <input required="required" type="text" name="model" class="form-control" value="{{isset($item->car->model) ? $item->car->model : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="manufacture_year" class="control-label">Год выпуска:</label>
        <input  required="required" type="date" class="form-control" name="manufacture_year" value="{{isset($item->car->manufacture_year) ? $item->car->manufacture_year : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="vin" class="control-label">VIN:</label>
        <input required="required" type="text" name="vin" class="form-control" value="{{isset($item->car->vin) ? $item->car->vin : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="kpp" class="control-label">КПП:</label>
        <input required="required" type="text" name="kpp" class="form-control" value="{{isset($item->car->kpp) ? $item->car->kpp : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="engine" class="control-label">Двигатель:</label>
        <input required="required" type="text" name="engine" class="form-control" value="{{isset($item->car->engine) ? $item->car->engine : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="power" class="control-label">Мощность:</label>
        <input required="required" type="text" name="power" class="form-control" value="{{isset($item->car->power) ? $item->car->power : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="color" class="control-label">Цвет:</label>
        <input required="required" type="text" name="color" class="form-control" value="{{isset($item->car->color) ? $item->car->color : null}}">
    </div>
</div>
