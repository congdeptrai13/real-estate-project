<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    //
    public function Dashboard()
    {

        return view("agent.index");
    }

    public function AgentLogin()
    {
        return view("agent.agent_login");
    }

    public function AgentRegister(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            "role" => "agent",
            "status" => "inactive"
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);
    }

    public function AgentLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            "message" => "Agent logout successfully",
            "alert-type" => "success"
        ];
        return redirect('/agent/login')->with($notification);
    }

    public function AgentProfile()
    {
        $id = Auth::id();
        $profileAgent = User::find($id);
        return view("agent.agent_profile_view", compact("profileAgent"));
    }
    public function AgentProfileStore(Request $request)
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
            @unlink(public_path("upload/agent_images/") . $data->photo);
            $fileName = date("YmdHi") . $file->getClientOriginalName();
            $file->move(public_path("upload/agent_images"), $fileName);
            $data->photo = $fileName;
        }
        $data->save();
        $notification = [
            "message" => "Agent profile updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function AgentChangePassword()
    {
        $id = Auth::id();
        $profileAgent = User::find($id);
        return view("agent.agent_change_password", compact("profileAgent"));
    }

    public function AgentUpdatePassword(Request $request)
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
