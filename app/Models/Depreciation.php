<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depreciation extends Model
{
    protected $fillable=['name','number', 'sum', 'carrying_amount', 'residual_value'];
    public function item()
    {
        return  $this->belongsTo('App\Models\Item','item_id');
    }
    public function report()
    {
        return $this->belongsTo('App\Models\Item', 'report_id');
    }
}
