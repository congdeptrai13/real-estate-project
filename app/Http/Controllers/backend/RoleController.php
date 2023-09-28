<?php

namespace App\Http\Controllers\backend;

use App\Exports\PermissionExport;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RoleController extends Controller
{
    //

    public function AllPermission()
    {
        $permission = Permission::all();
        return view("backend.pages.permission.all_permission", compact("permission"));
    }

    public function AddPermission()
    {
        return view("backend.pages.permission.add_permission");
    }

    public function StorePermission(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
        $notification = [
            "message" => "Permission create successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.permission")->with($notification);
    }

    public function EditPermission($id)
    {
        $permission = Permission::find($id);
        return view("backend.pages.permission.edit_permission", compact("permission"));
    }

    public function UpdatePermission(Request $request)
    {
        Permission::find($request->id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
        $notification = [
            "message" => "Permission update successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.permission")->with($notification);
    }

    public function DeletePermission($id)
    {
        Permission::find($id)->delete();
        $notification = [
            "message" => "Permission deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function ImportPermission()
    {
        return view("backend.pages.permission.import_permission");
    }
    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request)
    {
        Excel::import(new PermissionImport, $request->import_file);

        $notification = [
            "message" => "Permission imported successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }


    public function AllRoles()
    {
        $roles = Role::all();
        return view("backend.pages.roles.all_roles", compact('roles'));
    }

    public function AddRoles()
    {
        return view("backend.pages.roles.add_roles");
    }

    public function StoreRoles(Request $request)
    {
        $roles = Role::create([
            'name' => $request->name,
        ]);
        $notification = [
            "message" => "Role create successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.roles")->with($notification);
    }

    public function EditRoles($id)
    {

        $roles = Role::find($id);
        return view("backend.pages.roles.edit_roles", compact("roles"));
    }

    public function UpdateRoles(Request $request)
    {
        Role::find($request->id)->update([
            'name' => $request->name,
        ]);
        $notification = [
            "message" => "Role update successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.roles")->with($notification);
    }

    public function DeleteRoles($id)
    {
        Role::find($id)->delete();
        $notification = [
            "message" => "Role update successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }



    public function AddRolesPermission()
    {
        $roles = Role::all();
        $group_permission = User::getGroupPermission();
        return view("backend.pages.rolesetup.add_roles_permission", compact("roles", 'group_permission'));
    }

    public function StorePermissionRoles(Request $request)
    {
        $data = array();
        $permissions = $request->permissions;
        $role_id = $request->role_id;
        foreach ($permissions as $key => $permission) {
            $data["permission_id"] = $permission;
            $data["role_id"] = $role_id;
            DB::table('role_has_permissions')->insert($data);
        }
        $notification = [
            "message" => "Role Permission created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.roles.permission")->with($notification);
    }

    public function AllRolesPermission()
    {
        $roles = Role::all();
        return view("backend.pages.rolesetup.all_roles_permission", compact("roles"));
    }

    public function EditRolesPermission($id)
    {
        $roles = Role::find($id);
        $group_permission = User::getGroupPermission();
        return view("backend.pages.rolesetup.edit_roles_permission", compact("roles", 'group_permission'));
    }


    public function UpdateRolesPermission(Request $request, $id)
    {
        $role = Role::find($id);
        $permissions = $request->permissions;
        $role->syncPermissions($permissions);
        $notification = [
            "message" => "Role Permission updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.roles.permission")->with($notification);
    }

    public function DeleteRolesPermission($id)
    {
        $role = Role::find($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = [
            "message" => "Role Permission deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.roles.permission")->with($notification);
    }
}
