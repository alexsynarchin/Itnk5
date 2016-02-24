<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [];
    public $timestamps = false;
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
    public static $car_type = array(
        'car' => 'Легковой',
        'truck' => 'Грузовой'
    );
}
