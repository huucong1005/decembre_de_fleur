<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'info_name','info_address','info_contact', 'info_map', 'info_image','info_fanpage','info_gmail','info_slogan','info_bank',
    ];
    protected $primaryKey ='info_id';
    protected $table ='info';
}
