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
        return $this->hasOne('App\Models\Building');
    }
    public function parcel(){
        return $this->hasOne('App\Models\Parcel');
    }
    public  function address(){
        return $this->hasOne('App\Models\Address','item_id');
    }
    public  function variable(){
        return $this->hasOne('App\Models\Variable');
    }
    public  function car(){
        return $this->hasOne('App\Models\Car');
    }
    public static $os_finance = array(
        'budget' => 'Бюджет',
        'out_budget' => 'Внебюджет'
    );
}
