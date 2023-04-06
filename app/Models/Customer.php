<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'customer_name', 
        'customer_email', 
        'customer_phone', 
        'customer_password', 
        'customer_token', 

    ];
    protected $primaryKey ='customer_id';
    protected $table ='customer';
}
