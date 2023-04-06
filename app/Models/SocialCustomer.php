<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialCustomer extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'provider_user_id','provider_user_email', 'provider', 'user'
    ];

    protected $primaryKey = 'user_id';
    protected $table = 'social_customer';

    public function customer(){
        return $this->belongsTo('App\Models\Customer','user');
    }
}
