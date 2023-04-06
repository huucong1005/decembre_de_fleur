<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'role_id', 
        'permission_id', 
         
    ];
    protected $primaryKey ='id';
    protected $table ='permission_role';
}
