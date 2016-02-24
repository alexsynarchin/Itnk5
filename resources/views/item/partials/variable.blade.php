<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="residual_value" class="control-label">Остаточная стоимость:</label>
        <input  type="decimal" name="residual_value" class="form-control" value="{{isset($item->variable->residual_value)? $item->variable->residual_value :null}}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="exploitation_date" class="control-label">Дата ввода в эксплуатацию:</label>
        <input  type="date" name="exploitation_date" class="form-control" value="{{isset($item->variable->exploitation_date) ? $item->variable->exploitation_date : null }}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="monthly_rate" class="control-label">Месячная норма:</label>
        <input required="required" type="decimal" name="monthly_rate" class="form-control" value="{{isset($item->variable->monthly_rate) ? $item->variable->monthly_rate : null}}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="useful_life" class="control-label">Срок полезного использования:</label>
        <input  required="required" type="number" name="useful_life" class="form-control" value="{{isset($item->variable->useful_life) ? $item->variable->useful_life : null}}">
    </div>
</div>