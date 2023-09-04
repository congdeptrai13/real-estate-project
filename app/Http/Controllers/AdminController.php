<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        return redirect('/admin/login');
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
            unlink(public_path("upload/admin_images/") . $data->photo);
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
}
