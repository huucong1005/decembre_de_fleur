<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'name_tp', 'type'
    ];
    protected $primaryKey ='id_tp';
    protected $table ='tinhthanhpho';
}
