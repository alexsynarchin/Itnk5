<h4 class="center">Адрес</h4>
<div class="form-group">
    <div class="os-form-group col-xs-6">
        <label for="state" class="control-label">Регион:</label>
        <input required="required" type="text" name="state" class="form-control" placeholder="Регион" value="{{isset($item->address->state) ? $item->address->state : null }}">
    </div>
    <div class="os-form-group col-xs-6">
        <label for="district" class="control-label">Район:</label>
        <input type="text" name="district" class="form-control" placeholder="Район" value="{{isset($item->address->district) ? $item->address->district : null }}">
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-xs-4">
        <label for="city" class="control-label">Город / Населенный пункт:</label>
        <input required="required" type="text" name="city" class="form-control" placeholder="Населенный пункт" value="{{isset($item->address->city) ? $item->address->city : null }}">
    </div>
    <div class="os-form-group col-xs-4">
        <label for="street" class="control-label">Улица:</label>
        <input required="required" type="text" name="street" class="form-control" placeholder="Улица" value="{{isset($item->address->street) ? $item->address->street : null }}">
    </div>
    <div class="os-form-group col-xs-2">
        <label for="building_number" class="control-label">Дом:</label>
        <input type="text" name="building_number" class="form-control" placeholder="Дом" value="{{isset($item->address->building_number) ? $item->address->building_number : null }}">
    </div>
    <div class="os-form-group col-xs-2">
        <label for="building_number_2" class="control-label">Корпус:</label>
        <input type="text" name="building_number_2" class="form-control" placeholder="Корпус" value="{{isset($item->address->building_number_2) ? $item->address->building_number_2 : null }}">
    </div>
</div>