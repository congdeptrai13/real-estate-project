<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    //
    public function AllTestimonial()
    {
        $testimonials = Testimonial::all();
        return view("backend.testimonial.all_testimonial", compact('testimonials'));
    }

    public function AddTestimonial()
    {
        return view("backend.testimonial.add_testimonial");
    }

    public function StoreTestimonial(Request $request)
    {
        $image = $request->file("image");
        $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(100, 100)->save("upload/testimonial/" . $name_gen);
        $save_url = "upload/testimonial/" . $name_gen;
        Testimonial::create([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            "image" => $save_url
        ]);
        $notification = [
            "message" => "Testimonial created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.testimonial")->with($notification);
    }

    public function EditTestimonial($id)
    {
        $testimonials = Testimonial::find($id);
        return view("backend.testimonial.edit_testimonial", compact("testimonials"));
    }

    public function UpdateTestimonial(Request $request)
    {
        $testimonial = Testimonial::find($request->id);
        if ($request->file('image')) {
            @unlink($testimonial->image);
            $image = $request->file("image");
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 275)->save("upload/testimonial/" . $name_gen);
            $save_url = "upload/testimonial/" . $name_gen;
            Testimonial::find($request->id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                "image" => $save_url
            ]);
            $notification = [
                "message" => "Testimonial updated successfully",
                "alert-type" => "success"
            ];
            return redirect()->route("all.testimonial")->with($notification);
        } else {
            Testimonial::find($request->id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
            ]);
            $notification = [
                "message" => "Testimonial updated without image successfully",
                "alert-type" => "success"
            ];
            return redirect()->route("all.testimonial")->with($notification);
        }
    }

    public function DeleteTestimonial($id)
    {
        $state = Testimonial::find($id);
        @unlink($state->image);
        $state->delete();

        $notification = [
            "message" => "Testimonial deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
