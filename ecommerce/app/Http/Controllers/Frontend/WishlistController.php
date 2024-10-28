<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    function WishlistAdd($id)
    {
        $wishlist = array();
        $wishlist['user_id'] = auth()->id();
        $wishlist['product_id'] = $id;

        $wishlist_check = DB::table('wishlists')->where('user_id', auth()->id())->where('product_id', $id)->first();

        if ($wishlist_check) {
            return response()->json('This Product already exits in your wishlist!');
        } else {
            if (auth()->check()) {
                DB::table('wishlists')->insert($wishlist);
                return response()->json('Wishlist Added!');
            } else {
                return response()->json('At first you have to login!');
            }
        }
    }


    function MyWishlist()
    {
        $count_wishlist = DB::table('wishlists')->where('user_id', Auth::user()->id)->count();

        $wishlist = DB::table('wishlists')->join('products', 'wishlists.product_id', 'products.id')->where('user_id', auth()->id())->select('wishlists.*', 'products.name', 'products.thumbnail')->get();
        return view('frontend.user.user_wishlist', compact('wishlist', 'count_wishlist'));
    }


    //remove wishlist remove method
    function RemoveWishlist($id)
    {
        DB::table('wishlists')->where('id', $id)->delete();
        return response()->json('This Item remove from wishlists!');
    }
}
