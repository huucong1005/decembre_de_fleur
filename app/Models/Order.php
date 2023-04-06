<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable =[
        'customer_id', 
        'shipping_id', 
        'order_status', 
        'order_code',
        'order_date',
        'created_at'
    ];
    protected $primaryKey ='order_id';
    protected $table ='order';

    public function shipping(){
        return $this->belongsTo('App\Models\Shipping','shipping_id');
    }

}
