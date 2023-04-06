<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'role_name', 
        'role_desc', 
    ];
    protected $primaryKey ='role_id';
    protected $table ='roles';

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'permission_role','role_id', 'permission_id');
    }
}
