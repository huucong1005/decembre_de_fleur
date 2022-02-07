<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamp = false;
    protected $fillable =[
        'name_qh', 'type', 'id_tp'
    ];
    protected $primaryKey ='id_qh';
    protected $table ='quanhuyen';
}
