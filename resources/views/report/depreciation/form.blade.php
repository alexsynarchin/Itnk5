<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="name" class="control-label">Наименование:</label>
        <input required="required" type="text" name="name" class="form-control" value="{{$depreciation->name or null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="name" class="control-label">Инвертарный номер:</label>
        <input required="required" type="text" name="number" class="form-control" value="{{$depreciation->number or null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-4 col-xs-4">
        <label for="name" class="control-label">Балансовая стоимость:</label>
        <input required="required" type="number" name="carrying_amount" class="form-control" value="{{$depreciation->carrying_amount or null}}">
    </div>
    <div class="col-md-4 col-xs-4">
        <label for="name" class="control-label">Начисленный износ:</label>
        <input required="required" type="number" name="sum" class="form-control" value="{{$depreciation->sum or null}}">
    </div>
    <div class="col-md-4 col-xs-4">
        <label for="name" class="control-label">Остаточная стоимость:</label>
        <input required="required" type="number" name="residual_value" class="form-control" value="{{$depreciation->residual_value or null}}">
    </div>
</div>