<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'id_tp', 'td_qh', 'id_xptt', 'fee_ship'
    ];
    protected $primaryKey ='fee_id';
    protected $table ='feeship';

    public function city(){
        return $this->belongsTo('App\Models\City', 'id_tp');
    }
    public function province(){
        return $this->belongsTo('App\Models\province', 'id_qh');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards', 'id_xptt');
    }
}
