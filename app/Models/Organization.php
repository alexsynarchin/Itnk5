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
    public function residue(){
        return $this -> hasOne('App\Models\Residue', 'organization_id');
    }
    public function orgdocs()
    {
        return $this -> hasMany('App\Models\OrgDoc', 'organization_id');
    }
}
