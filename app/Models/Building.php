<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [];
    public $timestamps = false;
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
}
