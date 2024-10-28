<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;

class Blogcontroller extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    // blog category index method  
    function BlogcatIndex()
    {
        $blog_cat = DB::table('blog_categories')->get();
        return view('admin.blog.blog_cat.category_index', compact('blog_cat'));
    }

    //blog category store method
    function BlogcatStore(Request $request)
    {
        $blog_cat = new BlogCategory();
        $blog_cat->blog_cat_name = $request->blog_category_name;
        $blog_cat->status = $request->status;
        $blog_cat->save();

        $notification = array('message' => 'Blog Category Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    // blog cat edit method 
    function BlogcatEdit($id)
    {
        $blog_cat = DB::table('blog_categories')->where('id', $id)->first();
        return view('admin.blog.blog_cat.category_edit', compact('blog_cat'));
    }

    //blog cat update method
    function BlogcatUpdate(Request $request)
    {
        $blog_cat = array();
        $blog_cat['blog_cat_name'] = $request->blog_cat_name;
        $blog_cat['status'] = $request->status;

        DB::table('blog_categories')->where('id', $request->id)->update($blog_cat);

        $notification = array('message' => 'Blog Category Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //blog cat destroy method
    function BlogcatDestroy($id)
    {
        DB::table('blog_categories')->where('id', $id)->delete();

        $notification = array('message' => 'Blog Category Deleted!', 'alert-type' => 'warning');

        return redirect()->back()->with($notification);
    }


    //blog post index method
    function BlogpostIndex()
    {
        $blog_post = DB::table('blog_posts')->leftJoin('blog_categories', 'blog_posts.blog_category_id', 'blog_categories.id')->select('blog_categories.blog_cat_name', 'blog_posts.*')->get();
        return view('admin.blog.blog_post.index', compact('blog_post'));
    }

    // blog post store method 
    function BlogpostStore(Request $request)
    {
        $post = array();
        $post['blog_title'] = $request->blog_title;
        $post['blog_category_id'] = $request->blog_category_id;
        $post['blog_description_1'] = $request->description_1;
        $post['blog_description_2'] = $request->description_2;
        $post['blog_description_3'] = $request->description_3;
        $post['blog_description_4'] = $request->description_4;
        $post['blog_tag'] = $request->tag;
        if ($request->thumbnail) {
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $thumbnail = $request->thumbnail;
            $thumbnail_read = $manager->read($thumbnail);
            $thumbnail_name = $slug . "." . $thumbnail->getClientOriginalExtension();

            $resize = $thumbnail_read->resize(300, 300)->save('public/files/blog/' . $thumbnail_name);
            $data['thumbnail'] = 'public/files/blog/' . $thumbnail_name;
        }
        $post['status'] = $request->status;
        $post['date'] = $request->date;

        DB::table('blog_posts')->insert($post);
        $notification = array('message' => 'Blog post Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    //blog post edit method
    function BlogpostEdit($id)
    {
        $blog = DB::table('blog_posts')->leftJoin('blog_categories', 'blog_posts.blog_category_id', 'blog_categories.id')->where('blog_posts.id', $id)->select('blog_categories.blog_cat_name', 'blog_posts.*')->first();

        return view('admin.blog.blog_post.edit', compact('blog'));
    }


    //blog post update method
    function BlogpostUpdate(Request $request)
    {
        $blog = array();
        $blog['blog_title'] = $request->blog_title;
        $blog['blog_category_id'] = $request->blog_category_id;
        $blog['blog_description_1'] = $request->description_1;
        $blog['blog_description_2'] = $request->description_2;
        $blog['blog_description_3'] = $request->description_3;
        $blog['blog_description_4'] = $request->description_4;
        $blog['blog_tag'] = $request->tag;

        if ($request->thumbnail) {
            if (File::exists($request->old_thumbnail)) {
                unlink($request->old_thumbnail);
            }
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $thumbnail = $request->thumbnail;
            $thumbnail_read = $manager->read($thumbnail);
            $thumbnail_name = $slug . "." . $thumbnail->getClientOriginalExtension();

            $resize = $thumbnail_read->resize(300, 300)->save('public/files/blog/' . $thumbnail_name);
            $blog['thumbnail'] = 'public/files/blog/' . $thumbnail_name;
        } else {
            $blog['thumbnail'] = $request->old_thumbnail;
        }
        $blog['status'] = $request->status;
        $blog['date'] = $request->date;

        DB::table('blog_posts')->where('id', $request->id)->update($blog);
        $notification = array('message' => 'Blog post Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //blog post delete
    function BlogpostDestroy($id)
    {
        DB::table('blog_posts')->where('id', $id)->delete();
        $notification = array('message' => 'Blog post Deleted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
