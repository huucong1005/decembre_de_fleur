<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user', 'user_id' ,'role_id');
    }

    public function checkPermissionAccess($pemissionCheck){
//        1: lay dc tat ca quyen cua user dang login vao he thong
//        2: so sanh gia tri dua vao cua route hien tai vs gia tri cac quyen ma user do co

        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            if ($permissions->contains('key_code', $pemissionCheck)) {
                return true;
            }
        }
        return false;
    }

}
