<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable=[
        'year', 'quarter'
    ];
    public static $report_quarter = [
        1 => 'Первый',
        2 => 'Второй',
        3 => 'Третий',
        4 => 'Четвертый'
    ];
    public  static  $report_state = [
        'not_accepted' => 'Не принят',
        'inspection' => 'На проверке',
        'accepted' => 'Принят'
    ];
    public function organization(){
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }
}
