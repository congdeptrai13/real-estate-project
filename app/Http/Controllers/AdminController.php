<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    //
    public function AdminDashboard()
    {

        return view("admin.index");
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            "message" => "Admin logout successfully",
            "alert-type" => "success"
        ];
        return redirect('/admin/login')->with($notification);
    }

    public function AdminLogin()
    {

        return view("admin.admin_login");
    }

    public function AdminProfile()
    {
        $id = Auth::id();
        $profileAdmin = User::find($id);
        return view("admin.admin_profile_view", compact("profileAdmin"));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::id();
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file("photo")) {
            $file = $request->file("photo");
            @unlink(public_path("upload/admin_images/") . $data->photo);
            $fileName = date("YmdHi") . $file->getClientOriginalName();
            $file->move(public_path("upload/admin_images"), $fileName);
            $data->photo = $fileName;
        }
        $data->save();
        $notification = [
            "message" => "Admin profile updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::id();
        $profileAdmin = User::find($id);
        return view("admin.admin_change_password", compact("profileAdmin"));
    }

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            "old_password" => "required",
            "new_password" => "required|confirmed"
        ]);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                "message" => "Old password does not match",
                "alert-type" => "error"
            ];
            return back()->with($notification);
        }

        User::where("id", Auth::id())->update([
            "password" => Hash::make($request->new_password)
        ]);
        $notification = [
            "message" => "Change password successfully",
            "alert-type" => "success"
        ];
        return back()->with($notification);
    }

    public function AllAgent()
    {
        $allAgent = User::where("role", "agent")->get();
        return view("backend.agentuser.all_agent", compact("allAgent"));
    }

    public function AddAgent()
    {
        return view("backend.agentuser.add_agent");
    }

    public function StoreAgent(Request $request)
    {
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "password" => Hash::make($request->password),
            "role" => "agent",
            "status" => "active"
        ]);
        $notification = [
            "message" => "Agent created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.agent")->with($notification);
    }

    public function EditAgent($id)
    {
        $agent = User::find($id);
        return view("backend.agentuser.edit_agent", compact("agent"));
    }

    public function UpdateAgent(Request $request)
    {
        User::find($request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
        ]);
        $notification = [
            "message" => "Agent updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.agent")->with($notification);
    }

    public function DeleteAgent($id)
    {
        User::find($id)->delete();
        $notification = [
            "message" => "Agent deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user->status = $status;
        $user->save();
        return response()->json([
            "success" => "Status Changed Successfully"
        ]);
    }

    //admin controller
    public function AllAdmin()
    {
        $allAdmin = User::where("role", "admin")->get();
        return view("backend.pages.admin.all_admin", compact("allAdmin"));
    }

    public function AddAdmin()
    {
        $roles = Role::all();
        return view("backend.pages.admin.add_admin", compact('roles'));
    }

    public function StoreAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->role) {
            $user->assignRole($request->role);
        }
        $notification = [
            "message" => "Admin created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdmin($id)
    {
        $admin = User::find($id);
        $roles = Role::all();
        return view("backend.pages.admin.edit_admin", compact("admin", 'roles'));
    }

    public function UpdateAdmin(Request $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        $user->roles()->detach();
        if ($request->role) {
            $user->assignRole($request->role);
        }
        $notification = [
            "message" => "Admin updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdmin($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
        $notification = [
            "message" => "Admin User Deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->route('all.admin')->with($notification);
    }
}
