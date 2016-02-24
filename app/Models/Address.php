<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [];
    protected $table = 'addresses';
    public $timestamps = false;
    public function item(){
        return $this->belongsTo('App\Models\Item','item_id');
    }
}
