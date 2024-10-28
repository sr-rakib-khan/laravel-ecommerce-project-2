<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog_comment;

class FrontendBlogController extends Controller
{
    function BlogIndex()
    {
        $blog_cat =  DB::table('blog_categories')->get();
        $blog_post = DB::table('blog_posts')->leftJoin('blog_categories', 'blog_posts.blog_category_id', 'blog_categories.id')->select('blog_categories.blog_cat_name', 'blog_posts.*')->paginate(2);
        $recent_post = DB::table('blog_posts')->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.blog.blog_index', compact('blog_cat', 'blog_post', 'recent_post'));
    }

    //blog details method
    function BlogDetails($id)
    {
        $single_blog = DB::table('blog_posts')->leftJoin('blog_categories', 'blog_posts.blog_category_id', 'blog_categories.id')->where('blog_posts.id', $id)->select('blog_categories.blog_cat_name', 'blog_posts.*')->first();

        $blog_category = DB::table('blog_categories')->get();

        $recent_post = DB::table('blog_posts')->orderBy('id', 'DESC')->limit(4)->get();

        $blog_comment = Blog_comment::where('blog_id', $id)->paginate(4);
        $comment_count = Blog_comment::where('blog_id', $id)->count();
        return view('frontend.blog.blog_details', compact('single_blog', 'blog_category', 'recent_post', 'blog_comment', 'comment_count'));
    }

    function BlogSearch(Request $request)
    {
        $blog_post = DB::table('blog_posts')->leftJoin('blog_categories', 'blog_posts.blog_category_id', 'blog_categories.id')->select('blog_categories.blog_cat_name', 'blog_posts.*')->where('blog_title','LIKE', "%{$request->blog_search}%")->get();

        return view('frontend.blog.blog_search', compact('blog_post',));
    }
}
