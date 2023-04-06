<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'partner_name', 
        'partner_image', 
        'partner_link', 
    ];
    protected $primaryKey ='partner_id';
    protected $table ='partner';
}

