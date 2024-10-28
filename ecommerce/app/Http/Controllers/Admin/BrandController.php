<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    //index method of barand

    function index()
    {
        $brand = Brand::all();
        return view('admin.brand.index', compact('brand'));
    }

    //brand store method
    function Store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required',
        ]);

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->status = $request->status;

        $brand->save();

        $notification = array('message' => 'Brand Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //brand edit method
    function Edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    //brand update method
    function Update(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required',
        ]);
        $id = $request->id;

        $brand = Brand::findorFail($id);
        $brand->brand_name = $request->brand_name;
        $brand->status = $request->status;
        $brand->save();

        $notification = array('message' => 'Brand Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //brand delete method
    function Destroy($id)
    {
        $brand = Brand::findorFail($id);
        $brand->delete();

        $notification = array('message' => 'Brand Deleted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
