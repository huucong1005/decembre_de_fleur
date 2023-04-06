<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $fillable =[
        'permission_name', 
        'permission_desc', 
        'parent_id', 
    ];
    protected $primaryKey ='permission_id';
    protected $table ='permissions';

    public function permissionChildrent(){
        return $this->hasMany(Permission::class, 'parent_id');
    }
}
