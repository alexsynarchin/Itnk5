<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="name" class="control-label">Наименование:</label>
        <input required="required" type="text" name="name" class="form-control" value="{{$decommission->name or null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="number" class="control-label">Инвертарный номер:</label>
        <input required="required" type="text" name="number" class="form-control" value="{{$decommission->number or null}}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="number" class="control-label">Балансовая стоиомость:</label>
        <input required="required" type="decimal" name="carrying_amount" class="form-control" value="{{$decommission->carrying_amount or null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-4 col-xs-4">
        <label for="sum" class="control-label">Сумма списания:</label>
        <input required="required" type="decimal" name="sum" class="form-control" value="{{$decommission->sum or null}}">
    </div>
    <div class="col-md-4 col-xs-4">
        <label for="date" class="control-label">Дата списания:</label>
        <input required="required" type="date" name="date" class="form-control" value="{{$decommission -> date or null}}">
    </div>
    <div class="col-md-4 col-xs-4">
        <label for="type" class="control-label">Вид списания:</label>
        {!! Form::select('type', App\Models\Decommission::$decommission_type, isset($decommission->type) ? $decommission->type : null, array('class' => 'form-control')) !!}
    </div>
</div><div class="form-group">
    <div class="col-md-12">
        <label for="additional_field" class="control-label">Документы</label>
        <textarea class="form-control" name="document" rows="3" placeholder="Введите название дату и номер документа по которому произошло списание(реализация)">
            {{$decommission -> document or null}}
        </textarea>
    </div>
</div>