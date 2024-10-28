<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProductController extends Controller
{
    // category page show mehtod 
    function ShopCategory()
    {
        $product = DB::table('products')->where('status', 1)->inRandomOrder()->take(9)->get();
        $category = Category::all();
        $brand = Brand::all();

        return view('Frontend.shop_category', compact('product', 'category', 'brand'));
    }

    //category wise product method
    function CategoryWiseProduct($id)
    {
        $brand = Brand::all();
        $category = Category::all();
        $product = DB::table('products')->where('category_id', $id)->get();

        $category_name = DB::table('categories')->where('id', $id)->first();
        return view('Frontend.category_wise_product', compact('product', 'brand', 'category', 'category_name'));
    }


    function BrandWiseProduct($id)
    {
        $brand = Brand::all();
        $category = Category::all();
        $product = DB::table('products')->where('brand_id', $id)->get();

        $brand_name = DB::table('brands')->where('id', $id)->first();
        return view('Frontend.brand_wise_product', compact('product', 'brand', 'category', 'brand_name'));
    }
}
