<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //

    public function PropertyDetails($id, $slug)
    {
        $property = Property::find($id);
        $admin = User::where("role", "admin")->where("username", "admin")->first();
        $multiImage = MultiImage::where("property_id", $id)->get();
        $amenities = $property->amenities_id;
        $property_amen = explode(",", $amenities);
        $facilities = Facility::where("property_id", $id)->get();
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where("ptype_id", $type_id)->where("id", "!=", $id)->orderBy("id", "DESC")->limit(3)->get();

        return view("frontend.property.property_details", compact("property", 'admin', 'multiImage', 'property_amen', 'facilities', 'relatedProperty'));
    }

    public function SendMassage(Request $request)
    {
        $pid = $request->property_id;
        $aid = $request->agent_id;
        if (Auth::check()) {
            PropertyMessage::create([
                "user_id" => Auth::id(),
                "agent_id" => $aid,
                "property_id" => $pid,
                'msg_name' => $request->msg_name,
                "msg_email" => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message
            ]);
            $notification = [
                "message" => "Send Message Successfully",
                "alert-type" => "success"
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                "message" => "You need to login first",
                "alert-type" => "error"
            ];
            return redirect()->back()->with($notification);
        }
    }
}
