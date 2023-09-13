<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PropertyController extends Controller
{
    //
    public function AllProperty()
    {
        $property = Property::latest()->get();
        return view("backend.property.all_property", compact("property"));
    }

    public function AddProperty()
    {
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where("status", "active")->where("role", "agent")->latest()->get();
        return view("backend.property.add_property", compact("propertyType", "amenities", "activeAgent"));
    }

    public function StoreProperty(Request $request)
    {
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
            "agent_id" => $request->agent_id,
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
        //end facilities
        $notification = [
            "message" => "Property created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.property")->with($notification);
    }

    public function EditProperty($id)
    {
        $facilities = Facility::where("property_id", $id)->get();
        $property = Property::find($id);
        $type = $property->amenities_id;
        $multiImage = MultiImage::where("property_id", $id)->get();
        $property_ami = explode(',', $type);
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where("status", "active")->where("role", "agent")->latest()->get();
        return view("backend.property.edit_property", compact("property", "propertyType", "amenities", "activeAgent", 'property_ami', 'multiImage', 'facilities'));
    }

    public function UpdateProperty(Request $request)
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
            "agent_id" => $request->agent_id,
        ]);
        $notification = [
            "message" => "Property updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.property")->with($notification);
    }

    public function UpdatePropertyThumbnail(Request $request)
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
            unlink($oldImage);
        }
        $notification = [
            "message" => "Property Image updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function UpdatePropertyMultiImage(Request $request)
    {
        $imgs = $request->multiImg;
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::find($id);
            unlink($imgDel->photo_name);
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

    public function PropertyMultiImageDelete($id)
    {
        $oldImg = MultiImage::find($id);
        unlink($oldImg->photo_name);
        MultiImage::find($id)->delete();
        $notification = [
            "message" => "Property Multi Image deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function StoreNewMultiImage(Request $request)
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

    public function UpdatePropertyFacilities(Request $request)
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
}
