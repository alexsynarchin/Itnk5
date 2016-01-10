<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['document_date', 'actual_date', 'os_type'];
    public function items(){
        return $this->hasMany('App\Models\Item','document_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public static $os_types = array(
        'movables' => 'Движимое имущество',
        'value_movables' => 'Особо ценное движимое имущество',
        'buildings' => 'Здания и сооружения',
        'parcels' => 'Земельные участки',
        'car'   =>  'Автомобили'
    );
}
