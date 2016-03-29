<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Residue extends Model
{
    public $timestamps = false;
    public function organization(){
        return  $this->belongsTo('App\Models\Organization','organization_id');
    }
    public  static  $residual_entering_state = [
        'not_accepted' => 'Не принят',
        'inspection' => 'На проверке',
        'accepted' => 'Принят'
    ];
}
