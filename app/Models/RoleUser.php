<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'user_id',
        'role_id', 
         
    ];
    protected $primaryKey ='id';
    protected $table ='role_user';
}
