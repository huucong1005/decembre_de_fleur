<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'comment_name', 
        'comment_status', 
        'comment', 
        'comment_parent_comment', 
        'comment_product_id', 
    ];
    protected $primaryKey ='comment_id';
    protected $table ='comment';

    public function product(){
        return $this->belongsTo('App\Models\Product','comment_product_id');
    }
}
