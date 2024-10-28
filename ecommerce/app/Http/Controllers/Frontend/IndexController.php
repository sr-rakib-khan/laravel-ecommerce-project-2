<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class IndexController extends Controller
{
    function Index()
    {
        $newproduct = DB::table('products')->where('status', 1)->orderBy('id', 'DESC')->take(4)->get();
        $inspired = DB::table('products')->where('inspired_product', 1)->where('status', 1)->get();
        $featured = DB::table('products')->where('featured', 1)->where('status', 1)->inRandomOrder()->take(6)->get();

        $summer_season_product = DB::table('products')->where('season_status', 'summer')->inRandomOrder()->limit(1)->first();

        return view('frontend.index', compact('newproduct', 'inspired', 'featured', 'summer_season_product'));
    }


    //product details mehtod
    function ProductDetails($id)
    {
        $product = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')->leftJoin('brands', 'products.brand_id', 'brands.id')->where('products.id', $id)->select('categories.category_name', 'brands.brand_name', 'products.*')->first();

        // $comment = Comment::where('id', $id)->first();

        $comment = DB::table('comments')->where('product_id', $id)->get();

        // $comment_reply = DB::table('comment_replies')->where('comment_id', $comment->id)->get();

        $user = DB::table('users')->where('id', Auth::id())->first();

        $reviews = DB::table('reviews')->where('product_id', $id)->get();

        return view('Frontend.single_product', compact('product', 'user', 'reviews', 'comment'));
    }


    //search product

    function SearchProduct(Request $request)
    {
        $search_product = DB::table('products')->where('name', 'LIKE', "%{$request->search}%")->get();

        return view('frontend.search', compact('search_product'));
    }
}
