<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['document_date', 'actual_date', 'os_type', 'document_type','report_id'];
    public function items(){
        return $this->hasMany('App\Models\Item','document_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public static $os_types = array(
        'movables' => 'Движимое имущество',
        'value_movables' => 'Особо ценное движимое имущество',
        'buildings' => 'Здания и сооружения',
        'parcels' => 'Земельные участки',
        'car'   =>  'Автомобили'
    );
    public static function documentTitle ($document_type){
        switch($document_type){
            case 'purchase':
                $document_title="Приобретения";
                break;
            case 'residues_entering':
                $document_title="Ввода остатков";

        }
        return $document_title;
    }
}
