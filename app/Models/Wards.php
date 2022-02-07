<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamp = false;
    protected $fillable =[
        'name_xptt', 'type', 'id_qh'
    ];
    protected $primaryKey ='id_xptt';
    protected $table ='xaphuongthitran';
}
