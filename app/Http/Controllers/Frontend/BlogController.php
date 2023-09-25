<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //
    public function StoreComment(Request $request)
    {
        $pid = $request->post_id;
        Comment::create([
            "user_id" => Auth::id(),
            "post_id" => $pid,
            "parent_id" => null,
            "subject" => $request->subject,
            "message" => $request->message,

        ]);
        $notification = [
            "message" => "Create Comment successfully",
            "alert-type" => "successfully"
        ];
        return redirect()->back()->with($notification);
    }
    public function AllBlogComment()
    {
        $comments = Comment::where("parent_id", null)->latest()->get();
        return view("backend.comment.all_blog_comment", compact('comments'));
    }

    public function BlogReplyComment($id)
    {
        $comment = Comment::find($id);
        return view("backend.comment.reply_blog_comment", compact('comment'));
    }

    public function ReplyComment(Request $request)
    {
        $post_id = $request->post_id;
        $id = $request->id;
        $user_id = $request->user_id;
        Comment::create([
            "user_id" => $user_id,
            "post_id" => $post_id,
            "parent_id" => $id,
            "subject" => $request->subject,
            "message" => $request->message,

        ]);
        $notification = [
            "message" => "Create Comment successfully",
            "alert-type" => "successfully"
        ];
        return redirect()->back()->with($notification);
    }
}
