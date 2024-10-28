<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function Index()
    {
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    //category store method
    function Store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required',
        ]);


        $category = new Category();
        $category->category_name = $request->category_name;
        $category->slug = Str::slug($request->category_name, '-');
        $category->status = $request->status;

        $category->save();


        $notification = array('message' => 'Category Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //category edit method
    function Edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }


    //category update method
    function Update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $id = $request->id;

        $category = Category::findOrFail($id);
        $category->category_name = $request->name;
        $category->status = $request->status;
        $category->slug = Str::slug($request->name, '-');

        $category->save();

        $notification = array('message' => 'Category Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //category delete method
    function Destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $notification = array('message' => 'Category Deleted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
