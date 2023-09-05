<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function Index()
    {
        return view("frontend.index");
    }

    public function UserProfile()
    {
        $id = Auth::id();
        $userData = User::find($id);
        return view("frontend.dashboard.edit_profile", compact("userData"));
    }

    public function UserProfileStore(Request $request)
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
            if (!empty($data->photo)) {
                unlink(public_path("upload/user_images/") . $data->photo);
            }
            $fileName = date("YmdHi") . $file->getClientOriginalName();
            $file->move(public_path("upload/user_images"), $fileName);
            $data->photo = $fileName;
        }
        $data->save();
        $notification = [
            "message" => "User profile updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
