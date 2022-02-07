<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamp = false;
    protected $fillable =[
        'coupon_name', 'coupon_code', 'coupon_quantity', 'coupon_number', 'coupon_function'
    ];
    protected $primaryKey ='coupon_id';
    protected $table ='coupon';
}
