<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function SettingSmtp()
    {
        $smtp = SmtpSetting::find(1);
        return view("backend.setting.update_smtp", compact("smtp"));
    }

    public function UpdateSmtpMailer(Request $request)
    {
        SmtpSetting::find($request->id)->update([
            "mail" => $request->mail,
            "host" => $request->host,
            'post' => $request->post,
            "username" => $request->username,
            "password" => $request->password,
            "encryption" => $request->encryption,
            "from_address" => $request->from_address
        ]);

        $notification = [
            "message" => "Update SMTP successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
