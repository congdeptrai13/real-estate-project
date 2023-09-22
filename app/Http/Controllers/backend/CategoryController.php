<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function AllBlogCategory()
    {
        $categories = Category::latest()->get();
        return view("backend.category.blog_category", compact('categories'));
    }

    public function StoreBlogCategory(Request $request)
    {
        Category::create([
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name),
        ]);

        $notification = [
            "message" => "Category create successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function EditCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function UpdateBlogCategory(Request $request)
    {
        Category::find($request->cat_id)->update([
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name),
        ]);

        $notification = [
            "message" => "Category updated successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }

    public function DeleteCategory($id)
    {
        Category::find($id)->delete();
        $notification = [
            "message" => "Category deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
