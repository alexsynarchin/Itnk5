<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
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
    public function documents()
    {
        return $this->hasMany('App\Models\Document', 'report_id');
    }
}
