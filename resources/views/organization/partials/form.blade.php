<div class="form-group">
    <div class="os-form-group col-md-12  col-xs-12">
        <label  class="control-label">Полное наименование</label>
        <div class="input-container">
            <input type="text" required="required"  name="full_name" class="form-control" value="{{$organization->full_name or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-12  col-xs-12">
        <label  class="control-label">Сокращенное наименование</label>
        <div class="input-container">
            <input type="text" required="required"  name="short_name" class="form-control" value="{{$organization->short_name or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">Номер договора</label>
        <div class="input-container">
            <input type="text" required="required"  name="contract_number" class="form-control" value="{{$organization->contract_number or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">Дата договора</label>
        <div class="input-container">
            <input type="date" required="required"  name="date" class="form-control" value="{{$organization->date or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">ИНН</label>
        <div class="input-container">
            <input type="text" required="required"   name="inn" class="form-control" value="{{$organization->inn or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">КПП</label>
        <div class="input-container">
            <input type="text"   name="kpp" class="form-control" value="{{$organization->kpp or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">Фактический адрес</label>
        <div class="input-container">
            <input type="text"  required="required"  name="fact_address" class="form-control" value="{{$organization->fact_address or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">Юридический адрес</label>
        <div class="input-container">
            <input type="text" required="required"   name="legal_address" class="form-control" value="{{$organization->legal_address or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">РС</label>
        <div class="input-container">
            <input type="number"   name="rs" class="form-control" value="{{$organization->rs or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">ЛС</label>
        <div class="input-container">
            <input type="number"   name="ls" class="form-control" value="{{$organization->ls or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">КС</label>
        <div class="input-container">
            <input type="number"   name="ks" class="form-control" value="{{$organization->ks or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-3  col-xs-3">
        <label  class="control-label">БИК</label>
        <div class="input-container">
            <input type="number"   name="bik" class="form-control" value="{{$organization->bik or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">На основании чего действует для договора</label>
        <div class="input-container">
            <input type="text"  required="required"  name="operate_foundation" class="form-control" value="{{$organization->operate_foundation or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">В банке</label>
        <div class="input-container">
            <input type="text" required="required"   name="bank" class="form-control" value="{{$organization->bank or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-7  col-xs-7">
        <label  class="control-label">ФИО руководителя</label>
        <div class="input-container">
            <input type="text"  required="required"  name="fio" class="form-control" value="{{$organization->fio or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-5  col-xs-5">
        <label  class="control-label">Должность руководителя</label>
        <div class="input-container">
            <input type="text" required="required"   name="boss_position" class="form-control" value="{{$organization->boss_position or null}}">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">Телефон</label>
        <div class="input-container">
            <input type="text"  required="required"  name="phone" class="form-control" value="{{$organization->phone or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">e-mail</label>
        <div class="input-container">
            <input type="email" required="required"   name="email" class="form-control" value="{{$organization->email or null}}">
        </div>
    </div>
</div>
<h4>Ответственный сотрудник:</h4>
<div class="form-group">
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">Имя пользователя:</label>
        <div class="input-container">
            <input type="text"  required="required"  name="username" class="form-control" value="{{$organization->user->username or null}}">
        </div>
    </div>
    @if($form_type == 'create')
    <div class="os-form-group col-md-6  col-xs-6">
        <label  class="control-label">Пароль</label>
        <div class="input-container">
            <input type="text" required="required"   name="password" class="form-control">
        </div>
    </div>
    @endif
</div>
<div class="form-group">
    <div class="os-form-group col-md-4  col-xs-4">
        <label  class="control-label">Имя:</label>
        <div class="input-container">
            <input type="text"  required="required"  name="first_name" class="form-control" value="{{$organization->user->first_name or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-4  col-xs-4">
        <label  class="control-label">Фамилия:</label>
        <div class="input-container">
            <input type="text"  required="required"  name="last_name" class="form-control" value="{{$organization->user->last_name or null}}">
        </div>
    </div>
    <div class="os-form-group col-md-4  col-xs-4">
        <label  class="control-label">Отчество:</label>
        <div class="input-container">
            <input type="text"    name="surname" class="form-control" value="{{$organization->user->surname or null}}">
        </div>
    </div>
</div>