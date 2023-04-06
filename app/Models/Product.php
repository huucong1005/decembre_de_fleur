<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable =[
        'product_name',
        'product_slug',
        'product_quantity',
        'product_sold',
        'category_id',
        'brand_id',
        'product_desc',
        'product_content',
        'product_tags',
        'product_view',
        'product_cost',
        'product_price',
        'product_discount',
        'product_image',
        'product_status',

    ];
    protected $primaryKey ='product_id';
    protected $table ='product';

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }

    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
