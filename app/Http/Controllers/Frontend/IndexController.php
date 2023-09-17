<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //

    public function PropertyDetails($id, $slug)
    {
        return view("frontend.property.property_details");
    }
}
