<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StateController extends Controller
{
    //

    public function AllState()
    {
        $state = State::all();
        return view("backend.state.all_state", compact('state'));
    }

    public function AddState()
    {
        return view("backend.state.add_state");
    }

    public function StoreState(Request $request)
    {
        $image = $request->file("state_image");
        $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 275)->save("upload/state/" . $name_gen);
        $save_url = "upload/state/" . $name_gen;
        State::create([
            'state_name' => $request->state_name,
            "state_image" => $save_url
        ]);
        $notification = [
            "message" => "Property state created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.state")->with($notification);
    }

    public function EditState($id)
    {
        $state = State::find($id);
        return view("backend.state.edit_state", compact("state"));
    }

    public function UpdateState(Request $request)
    {
        $state = State::find($request->id);
        if ($request->file('state_image')) {
            @unlink($state->state_image);
            $image = $request->file("state_image");
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 275)->save("upload/state/" . $name_gen);
            $save_url = "upload/state/" . $name_gen;
            State::find($request->id)->update([
                'state_name' => $request->state_name,
                "state_image" => $save_url
            ]);
            $notification = [
                "message" => "Property state updated successfully",
                "alert-type" => "success"
            ];
            return redirect()->route("all.state")->with($notification);
        } else {
            State::find($request->id)->update([
                'state_name' => $request->state_name,
            ]);
            $notification = [
                "message" => "Property state updated without state image successfully",
                "alert-type" => "success"
            ];
            return redirect()->route("all.state")->with($notification);
        }
    }

    public function DeleteState($id)
    {
        $state = State::find($id);
        @unlink($state->state_image);
        $state->delete();

        $notification = [
            "message" => "State deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
