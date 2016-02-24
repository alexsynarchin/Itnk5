<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="name" class="control-label">Наименование:</label>
        <input required="required" type="text" name="name" class="form-control" value="{{isset($item->name) ? $item->name : null}}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 col-xs-12">
        <label for="number" class="control-label">Инвертарный номер:</label>
        <input required="required" type="text" name="number" class="form-control" value ="{{isset($item->number) ? $item->number : null }}">
    </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="financing_source" class="control-label">Источник финансирования:</label>
        {!! Form::select('financing_source', App\Models\Item::$os_finance, isset($item->financing_source) ? $item->financing_source : null, array('class' => 'form-control')) !!}
    </div>
</div>
@if(($document->os_type=='movables')||($document->os_type=='value_movables')||($document->os_type=='buildings')||($document->os_type=='car'))
    @include('item.partials.okof')
@endif
@if ($document->os_type=='buildings')
    @include('item.partials.building')
@endif
@if ($document->os_type == 'parcels')
    @include('item.partials.parcel')
@endif
@if (($document->os_type == "buildings") ||($document->os_type == "parcels"))
    @include('item.partials.address')
@endif
@if ($document->os_type == 'car')
    @include('item.partials.car')
@endif
<div class="form-group">
    <div class="col-md-6 col-xs-6">
        <label for="carrying_amount" class="control-label">Балансовая стоимость:</label>
        <input required="required" type="decimal" name="carrying_amount" class="form-control" value="{{isset($item->carrying_amount) ? $item->carrying_amount : null }}">
    </div>
    <div class="col-md-6 col-xs-6">
        <label for="os_date" class="control-label">Дата принятия к учету:</label>
        <input required="required" type="date" name="os_date" class="form-control" value="{{isset($item->os_date) ? $item->os_date : null}}">
    </div>
</div>
@if(($document->os_type=='movables')||($document->os_type=='value_movables')||($document->os_type=='buildings')||($document->os_type=='car'))
    @include('item.partials.variable')
@endif