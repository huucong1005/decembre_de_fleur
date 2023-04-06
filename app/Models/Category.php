<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable =[
        'category_name','category_slug', 'category_parent', 'category_desc', 'category_status','category_order'
    ];
    protected $primaryKey ='category_id';
    protected $table ='category';

    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
