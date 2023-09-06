<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    //

    public function AllType()
    {
        $types = PropertyType::latest()->get();
        return view("backend.type.all_type", compact("types"));
    }

    public function AddType()
    {
        return view("backend.type.add_type");
    }

    public function StoreType(Request $request)
    {
        $request->validate([
            "type_name" => "required | unique:property_types|max:200",
            "type_icon" => "required"
        ]);
        PropertyType::create([
            "type_name" => $request->type_name,
            "type_icon" => $request->type_icon
        ]);

        $notification = [
            "message" => "Property create successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.type")->with($notification);
    }


    public function EditType(Request $request, $id)
    {
        $type = PropertyType::find($id);
        return view("backend.type.edit_type", compact("type"));
    }

    public function UpdateType(Request $request)
    {
        $pid = $request->id;
        PropertyType::find($pid)->update([
            "type_name" => $request->type_name,
            "type_icon" => $request->type_icon
        ]);

        $notification = [
            "message" => "Property type updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.type")->with($notification);
    }

    public function DeleteType($id)
    {
        PropertyType::find($id)->delete();
        $notification = [
            "message" => "Property type deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    //amenitiescontroller 
    public function AllAmenity()
    {
        $amenities = Amenities::latest()->get();
        return view("backend.amenities.all_amenities", compact("amenities"));
    }

    public function AddAmenity()
    {
        return view("backend.amenities.add_amenities");
    }

    public function StoreAmenity(Request $request)
    {
        Amenities::create([
            "amenity_name" => $request->amenity_name,
        ]);

        $notification = [
            "message" => "Amenity create successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.amenity")->with($notification);
    }

    public function EditAmenity($id)
    {
        $amenity = Amenities::find($id);
        return view("backend.amenities.edit_amenities", compact("amenity"));
    }

    public function UpdateAmenity(Request $request)
    {
        $aid = $request->id;
        Amenities::find($aid)->update([
            "amenity_name" => $request->amenity_name,
        ]);

        $notification = [
            "message" => "Amenity updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.amenity")->with($notification);
    }

    public function DeleteAmenity($id)
    {
        Amenities::find($id)->delete();
        $notification = [
            "message" => "Amenity deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
