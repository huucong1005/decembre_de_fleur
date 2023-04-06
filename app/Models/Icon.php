<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'name', 
        'icon', 
        'link', 
    ];
    protected $primaryKey ='id_icon';
    protected $table ='icon';
}

