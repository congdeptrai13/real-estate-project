<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    public function SiteSetting()
    {
        $setting = SiteSetting::find(1);
        return view("backend.setting.site_setting", compact("setting"));
    }

    public function UpdateSiteSetting(Request $request)
    {
        $setting = SiteSetting::find($request->id);
        if ($request->file('logo')) {
            @unlink($setting->logo);
            $image = $request->file("logo");
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(1500, 386)->save("upload/logo/" . $name_gen);
            $save_url = "upload/logo/" . $name_gen;
            SiteSetting::find($request->id)->update([
                'support_phone' => $request->support_phone,
                "address_company" => $request->address_company,
                "email" => $request->email,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "copyright" => $request->copyright,
                "logo" => $save_url,
            ]);
            $notification = [
                "message" => "Site Setting updated successfully",
                "alert-type" => "success"
            ];
            return redirect()->back()->with($notification);
        } else {
            SiteSetting::find($request->id)->update([
                'support_phone' => $request->support_phone,
                "address_company" => $request->address_company,
                "email" => $request->email,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "copyright" => $request->copyright,
            ]);
            $notification = [
                "message" => "site setting updated without image successfully",
                "alert-type" => "success"
            ];
            return redirect()->back()->with($notification);
        }
    }
}
