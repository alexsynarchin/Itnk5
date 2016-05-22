<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $dates =['inspection_date','accepted_date'];
    protected $fillable=[
        'year', 'quarter'
    ];
    public static $report_quarter = [
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4'
    ];
    public  static  $report_state = [
        'not_accepted' => 'Не принят',
        'inspection' => 'На проверке',
        'accepted' => 'Принят'
    ];
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }
    public function depreciations()
    {
        return $this->hasMany('App\Models\Depreciation');
    }
    public function decommissions()
    {
        return $this->hasMany('App\Models\Decommission');
    }
    public function documents()
    {
        return $this->hasMany('App\Models\Document', 'report_id');
    }
    public  function items(){
        return $this -> hasManyThrough('App\Models\Item', 'App\Models\Document');
    }
}
