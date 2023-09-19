<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function AddWishlist(Request $request, $property_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where("user_id", Auth::id())->where("property_id", $property_id)->first();
            if (!$exists) {
                Wishlist::create([
                    "user_id" => Auth::id(),
                    "property_id" => $property_id
                ]);
                return response()->json([
                    "success" => "Added To Wishlish Succesfully"
                ]);
            } else {
                return response()->json([
                    "error" => "Wishlist had been added"
                ]);
            }
        } else {
            return response()->json([
                "error" => "You Need to Login first"
            ]);
        }
    }

    public function UserWishlist()
    {
        $id = Auth::id();
        $userData = User::find($id);
        return view("frontend.dashboard.wishlist", compact("userData"));
    }

    public function GetAllWishlist()
    {
        $wishlist = Wishlist::with("property")->where("user_id", Auth::id())->latest()->get();

        $wishlistQty = Wishlist::where("user_id", Auth::id())->count();
        return response()->json([
            "wishlist" => $wishlist,
            "wishlistQty" => $wishlistQty
        ]);
    }

    public function RemoveWishlist($id)
    {
        Wishlist::where("user_id", Auth::id())->where("id", $id)->delete();
        return response()->json([
            "success" => "Remove property in wishlist successfully"
        ]);
    }
}
