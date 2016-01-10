<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','number','carrying_amount','financing_source','os_view','okof','additional_field'];
    public function document(){
        return $this->belongsTo('App\Models\Document');
    }
    public function building(){
        return $this->hasOne('Building');
    }
    public function parcel(){
        return $this->hasOne('Parcel');
    }
    public  function address(){
        return $this->hasOne('Address','item_id');
    }
    public  function variable(){
        return $this->hasOne('Variable');
    }
    public  function car(){
        return $this->hasOne('Car');
    }
    public static $os_finance = array(
        'budget' => 'Бюджет',
        'out_budget' => 'Внебюджет'
    );
}
