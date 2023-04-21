<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
    //     $this->middleware('permission:view roleslist|delete-role|edit-role|view-role', ['only' => ['index','show',]]);
    //     $this->middleware('permission:create-user', ['only' => ['create','store']]);
    //   $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
    //    $this->middleware('permission:delete-user', ['only' => ['destroy']]);
        $this->middleware('auth');
    }
    public function index()
    {
    
            $roles=Role::all();
            return view('auth.roles.index',compact('roles'));
    }

    public function rolePermissions($id)
    {
    
        $roles=Role::find($id);
        $permissions = Permission::join('role_has_permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                  ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                  ->where('role_has_permissions.role_id',$id)
                  ->get(['permissions.name','permissions.id']);
                  return view('auth.roles.perm',compact('roles','permissions'));
    }

    public function create()
    {
        
        return view('auth.roles.create');

    }

    public function store(request $request)
    {
            $role = Role::create(['name' => $request->name]);
            return redirect('/role-list')->with('status',"Role created successfully!");
    }
    public function edit($id)
    {
        $roles=Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
    
    return view('auth.roles.edit',compact('roles','permission','rolePermissions'));
    }




    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
            ]);
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->syncPermissions($request->input('permission'));
            $role->update();
            return redirect('/role-list')
            ->with('status','Role updated successfully');
    }

    public function destroy($id)
    {
    $role=Role::find($id);
   $role->delete();
    return redirect('/role-list')
    ->with('status','Role deleted successfully');
    }
}
