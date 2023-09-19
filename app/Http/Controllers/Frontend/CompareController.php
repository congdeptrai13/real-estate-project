<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    //

    public function AddToCompare(Request $request, $property_id)
    {
        if (Auth::check()) {
            $exists = Compare::where("user_id", Auth::id())->where("property_id", $property_id)->first();
            if (!$exists) {
                Compare::create([
                    "user_id" => Auth::id(),
                    "property_id" => $property_id
                ]);
                return response()->json([
                    "success" => "Added To compare Succesfully"
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

    public function UserCompare()
    {
        $id = Auth::id();
        $userData = User::find($id);
        return view("frontend.dashboard.compare", compact("userData"));
    }

    public function GetAllCompare()
    {
        $wishlist = Compare::with("property")->where("user_id", Auth::id())->latest()->get();
        return response()->json($wishlist);
    }

    public function RemoveCompare($id)
    {
        Compare::where("user_id", Auth::id())->where("id", $id)->delete();
        return response()->json([
            "success" => "Remove property in compare successfully"
        ]);
    }
}
