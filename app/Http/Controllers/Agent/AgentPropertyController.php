<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\ScheduleMail;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\Property;
use App\Models\PropertyMessage;
use App\Models\PropertyType;
use App\Models\Schedule;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class AgentPropertyController extends Controller
{
    //
    public function AgentAllProperty()
    {
        $id = Auth::id();
        $property = Property::where("agent_id", $id)->latest()->get();
        return view("agent.property.all_property", compact("property"));
    }

    public function AgentAddProperty()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $propertyState = State::latest()->get();

        $id = Auth::id();
        $property = User::where("role", "agent")->where("id", $id)->first();
        $pcount = $property->credit;
        if ($pcount == 1 || $pcount == 7) {
            return view("agent.package.buy_package");
        } else {
            return view("agent.property.add_property", compact("propertyType", "amenities", 'propertyState'));
        }
    }


    public function AgentStoreProperty(Request $request)
    {
        $id = Auth::id();
        $uid = User::find($id);
        $nid = $uid->credit;
        $amen = implode(",", $request->amenities_id);
        $pcode = IdGenerator::generate([
            "table" => "properties",
            "field" => "property_code",
            "length" => 5,
            "prefix" => "PC"
        ]);

        $image = $request->file("property_thumbnail");
        $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save("upload/property/thumbnail/" . $name_gen);
        $save_url = "upload/property/thumbnail/" . $name_gen;

        $property_id = Property::create([
            "ptype_id" => $request->ptype_id,
            "amenities_id" => $amen,
            "property_name" => $request->property_name,
            "property_slug" => Str::slug($request->property_name),
            "property_code" => $pcode,
            "property_status" => $request->property_status,
            "lowest_price" => $request->lowest_price,
            "max_price" => $request->max_price,
            "short_description" => $request->short_description,
            "long_description" => $request->long_description,
            "bedrooms" => $request->bedrooms,
            "bathrooms" => $request->bathrooms,
            "garage" => $request->garage,
            "garage_size" => $request->garage_size,
            "property_size" => $request->property_size,
            "property_video" => $request->property_video,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "postal_code" => $request->postal_code,
            "neighborhood" => $request->neighborhood,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "featured" => $request->featured,
            "hot" => $request->hot,
            "agent_id" => Auth::id(),
            "status" => 1,
            "property_thumnail" => $save_url
        ]);
        //save multi-images
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . "." . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save("upload/property/multi-image/" . $make_name);
            $uploadPath = "upload/property/multi-image/" . $make_name;
            MultiImage::create([
                "property_id" => $property_id->id,
                "photo_name" => $uploadPath
            ]);
        }
        //end save multi-images

        //save facilities
        $facilities = count($request->facility_name);
        for ($i = 0; $i < $facilities; $i++) {
            $facility = new Facility();
            $facility->property_id = $property_id->id;
            $facility->facility_name = $request->facility_name[$i];
            $facility->distance = $request->distance[$i];
            $facility->save();
        }

        User::where("id", $id)->update([
            "credit" => DB::raw("1 + " . $nid)
        ]);
        //end facilities
        $notification = [
            "message" => "Property created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("agent.all.property")->with($notification);
    }

    public function AgentEditProperty($id)
    {
        $facilities = Facility::where("property_id", $id)->get();
        $property = Property::find($id);
        $type = $property->amenities_id;
        $multiImage = MultiImage::where("property_id", $id)->get();
        $property_ami = explode(',', $type);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $propertyState = State::latest()->get();

        return view("agent.property.edit_property", compact("property", "propertyType", "amenities", 'property_ami', 'multiImage', 'facilities', 'propertyState'));
    }

    public function AgentUpdateProperty(Request $request)
    {
        $id = $request->id;
        $amen = implode(",", $request->amenities_id);
        Property::find($id)->update([
            "ptype_id" => $request->ptype_id,
            "amenities_id" => $amen,
            "property_name" => $request->property_name,
            "property_slug" => Str::slug($request->property_name),
            "property_status" => $request->property_status,
            "lowest_price" => $request->lowest_price,
            "max_price" => $request->max_price,
            "short_description" => $request->short_description,
            "long_description" => $request->long_description,
            "bedrooms" => $request->bedrooms,
            "bathrooms" => $request->bathrooms,
            "garage" => $request->garage,
            "garage_size" => $request->garage_size,
            "property_size" => $request->property_size,
            "property_video" => $request->property_video,
            "address" => $request->address,
            "city" => $request->city,
            "state" => $request->state,
            "postal_code" => $request->postal_code,
            "neighborhood" => $request->neighborhood,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude,
            "featured" => $request->featured,
            "hot" => $request->hot,
            "agent_id" => Auth::id(),
        ]);
        $notification = [
            "message" => "Property updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("agent.all.property")->with($notification);
    }

    public function AgentUpdatePropertyThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        $image = $request->file("property_thumbnail");
        $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save("upload/property/thumbnail/" . $name_gen);
        $save_url = "upload/property/thumbnail/" . $name_gen;
        Property::find($pro_id)->update([
            "property_thumnail" => $save_url
        ]);
        if (file_exists($oldImage)) {
            @unlink($oldImage);
        }
        $notification = [
            "message" => "Property Image updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function AgentUpdatePropertyMultiImage(Request $request)
    {
        $imgs = $request->multiImg;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::find($id);
            @unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()) . "." . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save("upload/property/multi-image/" . $make_name);
            $uploadPath = "upload/property/multi-image/" . $make_name;
            MultiImage::find($id)->update([
                "photo_name" => $uploadPath
            ]);
        }
        $notification = [
            "message" => "Property Multi Image updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function AgentDeletePropertyMultiimage($id)
    {
        $oldImg = MultiImage::find($id);
        @unlink($oldImg->photo_name);
        MultiImage::find($id)->delete();
        $notification = [
            "message" => "Property Multi Image deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function AgentStoreNewMultiimage(Request $request)
    {
        $img = $request->multiImg;
        $make_name = hexdec(uniqid()) . "." . $img->getClientOriginalExtension();
        Image::make($img)->resize(770, 520)->save("upload/property/multi-image/" . $make_name);
        $uploadPath = "upload/property/multi-image/" . $make_name;
        MultiImage::create([
            "property_id" => $request->imageId,
            "photo_name" => $uploadPath
        ]);
        $notification = [
            "message" => "Property Multi Image added successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function AgentUpdatePropertyFacilities(Request $request)
    {
        $pid = $request->id;
        if ($request->facility_name == NULL) {
            return redirect()->back();
        } else {
            Facility::where("property_id", $pid)->delete();
            $facilities = count($request->facility_name);
            for ($i = 0; $i < $facilities; $i++) {
                $facility = new Facility();
                $facility->property_id = $pid;
                $facility->facility_name = $request->facility_name[$i];
                $facility->distance = $request->distance[$i];
                $facility->save();
            }
            //end facilities
            $notification = [
                "message" => "Property facilities updated successfully",
                "alert-type" => "success"
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function AgentDetailsProperty($id)
    {
        $facilities = Facility::where("property_id", $id)->get();
        $property = Property::find($id);
        $type = $property->amenities_id;
        $multiImage = MultiImage::where("property_id", $id)->get();
        $property_ami = explode(',', $type);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view("agent.property.details_property", compact("property", "propertyType", "amenities",  'property_ami', 'multiImage', 'facilities'));
    }

    public function AgentDeleteProperty($id)
    {
        $property = Property::find($id);
        @unlink($property->property_thumnail);
        Property::find($id)->delete();

        $multiImage = MultiImage::where("property_id", $id)->get();
        foreach ($multiImage as $img) {
            @unlink($img->photo_name);
            MultiImage::where("property_id", $id)->delete();
        }

        $facilitiesData = Facility::where("property_id", $id)->get();
        foreach ($facilitiesData as $facility) {
            Facility::where("property_id", $id)->delete();
        }
        $notification = [
            "message" => "Property deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function BuyPackage()
    {
        return view("agent.package.buy_package");
    }

    public function BuyBusinessPlan()
    {
        $data = Auth::user();
        return view("agent.package.buy_business_plan", compact("data"));
    }
    public function BuyProfessionalPlan()
    {
        $data = Auth::user();
        return view("agent.package.buy_professional_plan", compact("data"));
    }

    public function StoreBusinessPlan(Request $request)
    {
        $id = Auth::id();
        $uid = User::find($id);
        $nid = $uid->credit;
        PackagePlan::create([
            "user_id" => Auth::id(),
            "package_name" => "Business",
            "package_credits" => "3",
            "invoice" => "ERS" . mt_rand(1000000, 9999999),
            "package_amount" => "20",
        ]);

        User::where("id", $id)->update([
            "credit" => DB::raw("3 + " . $nid)
        ]);
        $notification = [
            "message" => "You have purchased basic package successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("agent.all.property")->with($notification);
    }

    public function StoreProfessionalPlan(Request $request)
    {
        $id = Auth::id();
        $uid = User::find($id);
        $nid = $uid->credit;
        PackagePlan::create([
            "user_id" => Auth::id(),
            "package_name" => "Professional",
            "package_credits" => "10",
            "invoice" => "ERS" . mt_rand(1000000, 9999999),
            "package_amount" => "50",
        ]);

        User::where("id", $id)->update([
            "credit" => DB::raw("10 + " . $nid)
        ]);
        $notification = [
            "message" => "You have purchased professional package successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("agent.all.property")->with($notification);
    }

    public function PackageHistory()
    {
        $id = Auth::id();
        $packagehistory = PackagePlan::where("user_id", $id)->get();
        return view("agent.package.package_history", compact("packagehistory"));
    }

    public function PackageHistoryInvoice($id)
    {
        $packhistory = PackagePlan::find($id);
        $pdf = Pdf::loadView('agent.package.package_history_invoice', compact("packhistory"))->setPaper("a4")->setOption([
            "tempDir" => public_path(),
            "chroot" => public_path()
        ]);
        return $pdf->download('invoice_' . $packhistory->invoice . '.pdf');
    }

    public function AgentPropertyMessage()
    {
        $id = Auth::id();
        $agent_msg =  PropertyMessage::where("agent_id", $id)->get();
        return view("agent.message.all_message", compact("agent_msg"));
    }

    public function AgentMessageDetails($id)
    {
        $message = PropertyMessage::find($id);
        $user_msg = User::find($message->user_id);
        $property_msg = Property::find($message->property_id);
        $agent_id = Auth::id();

        $agent_msg =  PropertyMessage::where("agent_id", $agent_id)->get();
        return view("agent.message.message_details", compact("user_msg", "property_msg", 'message', 'agent_msg'));
    }

    public function AgentScheduleRequest()
    {
        $id = Auth::id();
        $schedules = Schedule::where("agent_id", $id)->get();
        return view("agent.request.all_request", compact("schedules"));
    }

    public function AgentDetailsSchedule($id)
    {
        $request = Schedule::find($id);
        return view("agent.request.request_details", compact("request"));
    }

    public function AgentUpdateSchedule(Request $request)
    {

        Schedule::find($request->request_id)->update([
            "status" => 1
        ]);

        //send mail

        $schedule = Schedule::find($request->request_id);
        $data = [
            "tour_date" => $schedule->tour_date,
            "tour_time" => $schedule->tour_time,
        ];

        Mail::to($request->email)->send(new ScheduleMail($data));
        //end send mail
        $notification = [
            "message" => "Request update successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("agent.schedule.request")->with($notification);
    }
}
