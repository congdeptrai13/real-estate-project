<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\State;
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

    public function AgentDetails($id)
    {
        $agent = User::find($id);
        $property = Property::where("agent_id", $id)->latest()->get();
        $featured_property = Property::where("featured", "1")->limit(3)->latest()->get();
        $rentproperty = Property::where("property_status", "rent")->get();
        $buyproperty = Property::where("property_status", "buy")->get();
        return view("frontend.agent.agent_details", compact("agent", 'property', 'featured_property', 'rentproperty', 'buyproperty'));
    }

    public function AgentSendMassage(Request $request)
    {
        $aid = $request->agent_id;
        if (Auth::check()) {
            PropertyMessage::create([
                "user_id" => Auth::id(),
                "agent_id" => $aid,
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

    public function RentProperty()
    {
        $property = Property::where("property_status", "rent")->paginate(2);
        $buyproperty = Property::where("property_status", "buy")->get();
        $admin = User::where("role", "admin")->first();

        return view("frontend.property.rent_property", compact("property", 'buyproperty', 'admin'));
    }
    public function BuyProperty()
    {
        $property = Property::where("property_status", "buy")->get();
        $rentproperty = Property::where("property_status", "rent")->get();
        $admin = User::where("role", "admin")->first();

        return view("frontend.property.buy_property", compact("property", 'rentproperty', 'admin'));
    }

    public function PropertyType($id)
    {
        $property = Property::where("ptype_id", $id)->get();
        $rentproperty = Property::where("property_status", "rent")->get();
        $buyproperty = Property::where("property_status", "buy")->get();
        $admin = User::where("role", "admin")->first();
        $pbread = PropertyType::find($id);
        return view("frontend.property.property_type", compact("property", 'rentproperty', 'buyproperty', "admin", 'pbread'));
    }

    public function StateDetails($id)
    {
        $property = Property::where("status", "1")->where("state", $id)->latest()->paginate();
        $breadState = State::find($id)->state_name;
        $rentproperty = Property::where("property_status", "rent")->get();
        $buyproperty = Property::where("property_status", "buy")->get();
        return view("frontend.property.state_property", compact('breadState', 'rentproperty', 'buyproperty', 'property'));
    }

    public function BuyPropertySearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $sptype = $request->ptype_id;
        $rentproperty = Property::where("property_status", "rent")->get();

        $property = Property::where("property_name", "like", "%" . $item . "%")->where("property_status", "buy")->with("type", "pstate")
            ->whereHas("pstate", function ($q) use ($sstate) {
                $q->where("state_name", "like", "%" . $sstate . "%");
            })
            ->whereHas("type", function ($q) use ($sptype) {
                $q->where("type_name", "like", "%" . $sptype . "%");
            })->get();
        return view("frontend.property.search_property", compact("property", 'rentproperty'));
    }

    public function RentPropertySearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $sptype = $request->ptype_id;
        $rentproperty = Property::where("property_status", "buy")->get();

        $property = Property::where("property_name", "like", "%" . $item . "%")->where("property_status", "rent")->with("type", "pstate")
            ->whereHas("pstate", function ($q) use ($sstate) {
                $q->where("state_name", "like", "%" . $sstate . "%");
            })
            ->whereHas("type", function ($q) use ($sptype) {
                $q->where("type_name", "like", "%" . $sptype . "%");
            })->get();
        return view("frontend.property.search_property", compact("property", 'rentproperty'));
    }


    public function AllPropertySearch(Request $request)
    {
        $property_status = $request->property_status;
        $sstate = $request->state;
        $sptype = $request->ptype_id;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;
        $rentproperty = Property::where("property_status", "buy")->get();

        $property = Property::where("status", "1")
            ->where("bedrooms", $bedrooms)
            ->where('bathrooms', $bathrooms)
            ->where("property_status", $property_status)->with("type", "pstate")
            ->whereHas("pstate", function ($q) use ($sstate) {
                $q->where("state_name", "like", "%" . $sstate . "%");
            })
            ->whereHas("type", function ($q) use ($sptype) {
                $q->where("type_name", "like", "%" . $sptype . "%");
            })->get();
        return view("frontend.property.search_property", compact("property", 'rentproperty'));
    }
}
