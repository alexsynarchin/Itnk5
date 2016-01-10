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
}
