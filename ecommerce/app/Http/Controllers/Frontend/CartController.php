<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    function AddtoCart(Request $request)
    {
        $product = DB::table('products')->where('id', $request->id)->first();

        if ($request->qty) {
            $qty = $request->qty;
        } else {
            $qty = 1;
        }

        if ($product->discount_price == NULL) {
            $price = $product->selling_price;
        } else {
            $price = $product->discount_price;
        }

        Cart::add([
            'id' => $request->id,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $price,
            'options' => ['size' => $product->size, 'color' => $product->color, 'thumbnail' => $product->thumbnail]
        ]);

        return response()->json('Added to cart');
    }

    function AddsingleCart($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if ($product->discount_price == NULL) {
            $price = $product->selling_price;
        } else {
            $price = $product->discount_price;
        }

        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $price,
            'options' => ['size' => $product->size, 'color' => $product->color, 'thumbnail' => $product->thumbnail]
        ]);

        return response()->json('Added to cart');
    }


    function CartList()
    {
        $cart_list = Cart::content();
        return view('frontend.cart_list', compact('cart_list'));
    }

    function Removecartitem($id)
    {
        Cart::remove($id);
        return response()->json('Removed');
    }

    // cart update method 
    function CartQtyupdate($rowid, $qty)
    {
        Cart::update($rowid, ['qty' => $qty]);
        return response()->json('Quantity Updated');
    }

   
}
