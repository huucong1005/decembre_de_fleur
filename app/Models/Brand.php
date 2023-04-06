<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable =[
        'brand_name','brand_slug', 'brand_desc', 'brand_status','brand_order'
    ];
    protected $primaryKey ='brand_id';
    protected $table ='brand';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
