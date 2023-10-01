<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
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
                @unlink(public_path("upload/user_images/") . $data->photo);
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
        $notification = [
            "message" => "User logout successfully",
            "alert-type" => "success"
        ];
        return redirect('/login')->with($notification);
    }

    public function UserChangePassword()
    {
        $id = Auth::id();
        $userData = User::find($id);
        return view("frontend.dashboard.change_password", compact("userData"));
    }

    public function UserPasswordUpdate(Request $request)
    {
        $request->validate([
            "old_password" => "required",
            "new_password" => "required | confirmed"
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

    public function UserRequest()
    {
        $id = Auth::id();
        $userData = User::find($id);
        $userRequest = Schedule::where("user_id", $id)->get();
        return view("frontend.message.schedule_request", compact("userData", 'userRequest'));
    }

    public function LiveChat()
    {
        $id = Auth::id();
        $userData = User::find($id);
        return view("frontend.dashboard.live_chat", compact('userData'));
    }
}
