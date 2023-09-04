<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
