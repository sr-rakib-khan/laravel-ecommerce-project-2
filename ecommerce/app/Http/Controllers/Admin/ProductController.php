<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\Productnotification;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    function Create()
    {
        $category = Category::where('status', 1)->get();
        $brand = Brand::where('status', 1)->get();
        return view('admin.product.create', compact('category', 'brand'));
    }
    //product store method
    function Store(Request $request)
    {
        $Product = array();
        $Product['name'] = $request->product_name;
        $Product['slug'] = Str::slug($request->product_name, '-');
        $Product['code'] = $request->code;
        $Product['category_id'] = $request->category;
        $Product['unit'] = $request->unit;
        $Product['buying_price'] = $request->buying_price;
        $Product['featured'] = $request->featured;
        $Product['brand_id'] = $request->brand;
        $Product['tag'] = $request->tag;
        $Product['selling_price'] = $request->selling_price;
        $Product['inspired_product'] = $request->inspired;
        $Product['color'] = $request->color;
        $Product['size'] = $request->size;
        $Product['stock'] = $request->stock;
        $Product['discount_price'] = $request->discount_price;
        $Product['status'] = $request->status;
        $Product['season_status'] = $request->season_status;
        $Product['details'] = $request->details;
        $Product['admin_id'] = Auth::id();
        $Product['date'] = date('d,m,Y');
        $Product['month'] = date('F');

        //thumbanil
        if ($request->thumbnail) {
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $thumbnail = $request->thumbnail;
            $thumbnail_read = $manager->read($thumbnail);
            $thumbnail_name = $slug . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail_resize = $thumbnail_read->resize(300, 300)->save('public/files/product/' . $thumbnail_name);
            $Product['thumbnail'] = $thumbnail_name;
        }else{
            $Product['thumbnail'] = null;
        }


        // multiple images
        $images = array();
        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());
            foreach ($request->file('images') as $key => $image) {
                $image_read = $manager->read($image);
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                $image_resize =  $image_read->resize(300, 300)->save('public/files/product/' . $image_name);
                array_push($images, $image_name);
            }

            $Product['images'] = json_encode($images);
        }

        $get_last_id =  DB::table('products')->insertGetId($Product);

        $Product['id'] = $get_last_id;
        //send mail subscriber
        $subscriber = DB::table('newsletters')->get();
        foreach ($subscriber as $row) {
            Mail::to($row->email)->send(new ProductNotification($Product));
        }
        $notification = array('message' => 'Product Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //product index method
    function Index(Request $request)
    {
        if ($request->ajax()) {
            // $data = product::latest()->get();
            $imageurl = 'public/files/product';
            $product = "";
            $query = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')->leftJoin('brands', 'products.brand_id', 'brands.id');

            if ($request->category_id) {
                $query->where('products.category_id', $request->category_id);
            }
            if ($request->brand_id) {
                $query->where('products.brand_id', $request->brand_id);
            }
            if ($request->status == 1) {
                $query->where('products.status', 1);
            }
            if ($request->status == 0) {
                $query->where('products.status', 0);
            }
            $product = $query->select('categories.category_name', 'brands.brand_name', 'products.*')->get();

            return DataTables::of($product)->addIndexColumn()
                ->editColumn(
                    'thumbnail',
                    function ($row) use ($imageurl) {
                        return '<img src="' . $imageurl . '/' . $row->thumbnail . '" height="30" width="30">';
                    }
                )->editColumn(
                    'featured',
                    function ($row) {
                        if ($row->featured == 1) {
                            return '<a href="#" data-id="' . $row->id . '" class="featured-deactive"><i class="fa-solid fa-arrow-down text-danger p-1"></i><span class="badge badge-success">active</span></a>';
                        } else {
                            return '<a href="" data-id="' . $row->id . '" class="featured-active"><i class="fa-solid fa-arrow-up text-success  p-1"></i><span class="badge badge-danger">deactive</span></a>';
                        }
                    }
                )->editColumn(
                    'inspired_product',
                    function ($row) {
                        if ($row->inspired_product == 1) {
                            return '<a href="#" data-id="' . $row->id . '" class="inspired-no"><i class="fa-solid fa-arrow-down text-danger p-1"></i><span class="badge badge-success">Active</span></a>';
                        } else {
                            return '<a href="#" data-id="' . $row->id . '" class="inspired-yes"><i class="fa-solid fa-arrow-up  p-1"></i><span class="badge badge-danger">Deactive</span></a>';
                        }
                    }
                )->editColumn(
                    'status',
                    function ($row) {
                        if ($row->status == 1) {
                            return '<a href="#" data-id="' . $row->id . '" class="status-deactive"><i class="fa-solid fa-arrow-down text-danger p-1"></i><span class="badge badge-success">active</span></a>';
                        } else {
                            return '<a href="#" data-id="' . $row->id . '" class="status-active"><i class="fa-solid fa-arrow-up" p-1></i><span class="badge badge-danger">deactive</span></a>';
                        }
                    }
                )
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('product.edit', [$row->id]) . '" class="btn btn-info btn-sm view"><i class="fa-regular fa-pen-to-square"></i></a>
                    
                <a href="' . route('product.view', [$row->id]) . '" class="btn btn-info btn-sm view" data-bs-toggle="modal" data-bs-target="#productviewModal"><i class="fa-regular fa-eye"></i></a>
                
                <a href="' . route('product.delete', [$row->id]) . '" class="btn btn-info btn-sm product-delete"><i class="fa-solid fa-trash"></i></a>';

                    return $actionbtn;
                })->rawColumns(['action', 'thumbnail', 'featured', 'inspired_product', 'status'])->make(true);
        }
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('admin.product.index', compact('category', 'brand'));
    }

    // product view method 
    function view($id)
    {
        $path = 'public/files/product/';
        $product = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')->leftJoin('brands', 'products.brand_id', 'brands.id')->where('products.id', $id)->select('categories.category_name', 'brands.brand_name', 'products.*')->first();

        return view('admin.product.view', compact('product', 'path'));
    }

    //product edit method
    function Edit($id)
    {
        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        $product = DB::table('products')->where('id', $id)->first();
        return view('admin.product.edit', compact('category', 'brand', 'product'));
    }


    function Update(Request $request)
    {
        $product = DB::table('products')->where('id', $request->id)->first();

        $data = array();
        $data['name'] = $request->product_name;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $data['slug'] = Str::slug($request->product_name, '-');
        $data['code'] = $request->code;
        $data['unit'] = $request->unit;
        $data['buying_price'] = $request->buying_price;
        $data['featured'] = $request->featured;
        $data['tag'] = $request->tag;
        $data['selling_price'] = $request->selling_price;
        $data['inspired_product'] = $request->inspired;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $data['stock'] = $request->stock;
        $data['discount_price'] = $request->discount_price;
        $data['status'] = $request->status;
        $data['season_status'] = $request->season_status;
        $data['details'] = $request->details;

        if ($request->hasFile('thumbnail')) {
            $old_thumbanil = 'public/files/product/' . $request->old_thumbnail;
            if (File::exists($old_thumbanil)) {
                unlink($old_thumbanil);
            }
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $thumbnail = $request->thumbnail;
            $thumbnail_read = $manager->read($thumbnail);
            $thumbnail_name = $slug . "." . $thumbnail->getClientOriginalExtension();
            $thumbnail_resize = $thumbnail_read->resize(300, 300)->save('public/files/product/' . $thumbnail_name);
            $data['thumbnail'] = $thumbnail_name;
        } else {
            $data['thumbnail'] = $request->old_thumbnail;
        }

        if ($request->hasFile('images')) {
            $old_image = json_decode($request->old_images, true);

            foreach ($old_image as $image) {
                $old_images = 'public/files/product/' . $image;
                if (File::exists($old_images)) {
                    unlink($old_images);
                }
            }

            $images = array();
            $manager = new ImageManager(new Driver());
            foreach ($request->file('images') as $key => $image) {
                $image_read = $manager->read($image);
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                $image_resize =  $image_read->resize(300, 300)->save('public/files/product/' . $image_name);
                array_push($images, $image_name);
            }
            $data['images'] = json_encode($images);
        } else {
            $data['images'] = $request->old_images;
        }

        DB::table('products')->where('id', $request->id)->update($data);

        $notification = array('message' => 'Product Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    function Delete($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return response()->json('Product deleted');
    }

    //product not featured function
    function Not_Featured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured' => 0]);

        return response()->json('featured Deactivated');
    }

    function Featured($id)
    {
        DB::table('products')->where('id', $id)->update(['featured' => 1]);
        return response()->json('featured Activated');
    }

    //deactive inspired product
    function NO_Inspired($id)
    {
        DB::table('products')->where('id', $id)->update(['inspired_product' => 0]);
        return response()->json('Inspired Product Deactivated');
    }

    //active inspired product
    function Inspired($id)
    {
        DB::table('products')->where('id', $id)->update(['inspired_product' => 1]);
        return response()->json('Inspired Product Activated');
    }

    //product status deactive
    function Status_Deactive($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 0]);
        return response()->json('Product Status Deactivated');
    }

    //product status active
    function Status_Active($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 1]);
        return response()->json('Product Status Activated');
    }
}
