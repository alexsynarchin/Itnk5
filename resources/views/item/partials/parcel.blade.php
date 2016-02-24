<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="assigning_land" class="control-label">Назначение земель:</label>
        <input required="required" type="text" class="form-control" name="assigning_land" value="{{isset($item->parcel->assigning_land) ? $item->parcel->assigning_land : null}}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="cadastral" class="control-label">Кадастровый номер:</label>
        <input required="required" type="number" class="form-control" name="cadastral" value="{{isset($item->parcel->cadastral) ? $item->parcel->cadastral : null }}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="area" class="control-label">Площадь:</label>
        <input required="required" type="number" class="form-control" name="area" value="{{isset($item->parcel->area) ? $item->parcel->area : null }}">
    </div>
</div>