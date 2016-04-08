<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decommission extends Model
{
    protected $fillable=['name','number','sum','date','document','type','carrying_amount'];
    public  static $decommission_type=[
        'sale' => 'Продажа',
        'gratuitous transfer' => 'Безвозмездная передача',
        'decommission' => 'Списание'

    ];
    public function item()
    {
        return  $this->belongsTo('App\Models\Item','item_id');
    }
    public function report()
    {
        return $this->belongsTo('App\Models\Report', 'report_id');
    }
}
