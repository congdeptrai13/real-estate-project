<?php

namespace App\Http\Controllers\backend;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function EditPermission($id){
        $permission = Permission::find($id);
        return view("backend.pages.permission.edit_permission",compact("permission"));
    }

    public function UpdatePermission(Request $request){
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

    public function DeletePermission($id){
        Permission::find($id)->delete();
        $notification = [
            "message" => "Permission deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
