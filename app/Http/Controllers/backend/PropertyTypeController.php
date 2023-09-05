<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
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
}
