<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

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

    
}
