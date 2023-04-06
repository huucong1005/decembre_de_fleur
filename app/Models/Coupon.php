<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
	use SoftDeletes;
    public $timestamps = false;
    protected $fillable =[
        'coupon_name', 'coupon_code', 'coupon_quantity', 'coupon_number', 'coupon_function', 'coupon_start', 'coupon_end', 'coupon_status'
    ];
    protected $primaryKey ='coupon_id';
    protected $table ='coupon';
}
