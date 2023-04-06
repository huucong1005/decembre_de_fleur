<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   public $timestamps = false;
    protected $fillable =[
        'post_name',
        'post_slug',
        'post_image',
        'cate_post_id',
        'post_desc',
        'post_view',
        'post_content', 
        'post_status'

    ];
    protected $primaryKey ='post_id';
    protected $table ='post';


    public function cate_post(){
        return $this->belongsTo('App\Models\CategoryPost', 'cate_post_id');
    }
}
