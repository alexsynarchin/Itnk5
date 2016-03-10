<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function reports(){
        return $this -> hasMany('App\Models\Report', 'organization_id');
    }
}
