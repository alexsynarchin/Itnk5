<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="appointment" class="control-label">Назначение:</label>
        <input required="required" type="text" name="appointment" class="form-control" value="{{isset($item->building->appointment) ? $item->building->appointment : null}}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="floors" class="control-label">Этажность:</label>
        <input required="required" type="number" name="floors" class="form-control" value="{{isset($item->building->floors) ? $item->building->floors : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="appointment" class="control-label">Материал стен:</label>
        <input required="required" type="text" name="wall_material" class="form-control" value="{{isset($item->building->wall_material) ? $item->building->wall_material : null}}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="appointment" class="control-label">Год постройки:</label>
        <input required="required" type="date" name="date_construction" class="form-control" value="{{isset($item->building->date_construction) ? $item->building->date_construction : null}}">
    </div>
</div>