<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Blog_comment;
use DateTime;

class CommentController extends Controller
{
    function CommentStore(Request $request)
    {
        if (Auth::check()) {
            $comment = array();
            $comment['product_id'] = $request->product_id;
            $comment['name'] = $request->name;
            $comment['email'] = $request->email;
            $comment['phone'] = $request->phone;
            $comment['message'] = $request->message;
            $comment['created_at'] = date('Y-m-d H:i:s');

            DB::table('comments')->insert($comment);
            $notification = array('message' => 'Comment Inserted!', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $notification = array('message' => 'At first you have to login', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }


    function CommentreplyStore(Request $request)
    {
        if (Auth::check()) {
            $comment_reply = array();
            $comment_reply['porduct_id'] = $request->product_id;
            $comment_reply['comment_id'] = $request->comment_id;
            $comment_reply['name'] = Auth::user()->name;
            $comment_reply['email'] = Auth::user()->email;
            $comment_reply['phone'] = Auth::user()->phone;
            $comment_reply['comment'] = $request->comment;

            DB::table('comment_replies')->insert($comment_reply);

            return response()->json('comment added');
        } else {
            return response()->json('At first you have to login');
        }
    }

    function BlogCommentStore(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required',
        ]);

        $date = new DateTime();

        if (Auth::check()) {
            if ($request->name == null) {
                $name = Auth::user()->name;
            } else {
                $name = $request->name;
            }

            if ($request->email == null) {
                $email = Auth::user()->email;
            } else {
                $email = $request->email;
            }

            $blog = Blog_comment::create([
                'blog_id' => $request->blog_id,
                'name' => $name,
                'email' => $email,
                'comment' => $request->comment,
                'website' => $request->website,
                'created_at' => $date->format('Y-m-d H:i:s'),
            ]);

            $notification = array('message' => 'comment added', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $notification = array('message' => 'At first you have to login', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }

    function BlogCommentReplyStore(Request $request)
    {
    }
}
