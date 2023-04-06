<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Toastr;


class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission){
        $this->role=$role;
        $this->permission=$permission;
    }

    public function list_roles(){
        $roles=$this->role->get();
        return view('admin.role.list_role', compact('roles'));
    }

    public function add_roles(){
        $permissionsParent= $this->permission->where('parent_id',0)->get();
        return view('admin.role.add_role', compact('permissionsParent'));
    }

    public function store_roles(Request $request){
        $role= $this->role->create([
            'role_name'=>$request->role_name,
            'role_desc'=>$request->role_desc,
        ]);

        $role->permissions()->attach($request->permission_id);
        return Redirect::to('list-roles');

    }

    public function edit_roles($role_id){
        $permissionsParent= $this->permission->where('parent_id',0)->get();
        $role =$this->role->find($role_id);
        $permissionsChecked =$role->permissions;
        return view('admin.role.edit_role', compact('permissionsParent','role','permissionsChecked'));
    }

    public function update_roles(Request $request, $role_id){
        $role= $this->role->find($role_id);
        $role->update([
            'role_name'=>$request->role_name,
            'role_desc'=>$request->role_desc,
        ]);

        $role->permissions()->sync($request->permission_id);
        return Redirect::to('list-roles');

    }

    public function delete_roles($role_id){
        $role= $this->role->find($role_id);
        $role->delete();
        return Redirect::to('list-roles');
    }


}
