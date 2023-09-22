<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

    public function AllBlogPost()
    {
        $posts = BlogPost::latest()->get();
        return view("backend.post.all_post", compact("posts"));
    }

    public function AddBlogPost()
    {
        $blogcat = Category::latest()->get();

        return view("backend.post.add_post", compact('blogcat'));
    }

    public function StoreBlogPost(Request $request)
    {
        $image = $request->file("post_image");
        $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save("upload/post/" . $name_gen);
        $save_url = "upload/post/" . $name_gen;
        BlogPost::create([
            'blogcat_id' => $request->blogcat_id,
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'post_tags' => $request->post_tags,
            "post_image" => $save_url
        ]);
        $notification = [
            "message" => "Post created successfully",
            "alert-type" => "success"
        ];
        return redirect()->route("all.blog.post")->with($notification);
    }

    public function EditBlogPost($id)
    {
        $post = BlogPost::find($id);
        $blogcat = Category::latest()->get();

        return view("backend.post.edit_post", compact('post', 'blogcat'));
    }

    public function UpdatePost(Request $request)
    {
        $post = BlogPost::find($request->id);
        if ($request->file('post_image')) {
            @unlink($post->post_image);
            $image = $request->file("post_image");
            $name_gen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 275)->save("upload/post/" . $name_gen);
            $save_url = "upload/post/" . $name_gen;
            BlogPost::find($request->id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::id(),
                'post_title' => $request->post_title,
                'post_slug' => Str::slug($request->post_title),
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'post_tags' => $request->post_tags,
                "post_image" => $save_url
            ]);
            $notification = [
                "message" => "post updated successfully",
                "alert-type" => "success"
            ];
            return redirect()->route("all.blog.post")->with($notification);
        } else {
            BlogPost::find($request->id)->update([
                'blogcat_id' => $request->blogcat_id,
                'user_id' => Auth::id(),
                'post_title' => $request->post_title,
                'post_slug' => Str::slug($request->post_title),
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'post_tags' => $request->post_tags,
            ]);
            $notification = [
                "message" => "post updated without image successfully",
                "alert-type" => "success"
            ];
            return redirect()->route("all.blog.post")->with($notification);
        }
    }

    public function DeletePost($id)
    {
        $post = BlogPost::find($id);
        @unlink($post->post_image);
        $post->delete();

        $notification = [
            "message" => "post deleted successfully",
            "alert-type" => "success"
        ];
        return redirect()->back()->with($notification);
    }
}
