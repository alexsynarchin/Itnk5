<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgDoc extends Model
{
    public function organization()
    {
        return  $this -> belongsTo('App\Models\Organization', 'organization_id');
    }
}
