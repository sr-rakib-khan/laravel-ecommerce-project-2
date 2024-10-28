<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function Admin()
    {
        $total_product = DB::table('products')->count();
        $active_product = DB::table('products')->where('status', 1)->count();
        $inactive_product = DB::table('products')->where('status', 0)->count();
        $total_order = DB::table('orders')->count();

        $total_customer = DB::table('users')->where('is_admin', NULL)->count();

        $category = DB::table('categories')->where('status', 1)->count();

        $brand = DB::table('brands')->where('status', 1)->count();

        $coupon = DB::table('coupons')->where('status', 1)->count();

        $visitor_count = Visitor::count();

        $review = DB::table('reviews')->count();

        $subcriber = DB::table('newsletters')->count();

        $pending_order = DB::table('orders')->where('status', 0)->count();

        $received_order = DB::table('orders')->where('status', 1)->count();

        $complete_order = DB::table('orders')->where('status', 4)->count();

        $latest_order = DB::table('orders')->join('orders_details', 'orders.id', 'orders_details.order_id')->select('orders.*', 'orders_details.product_name')->limit(10)->get();



        return view('admin.dashboard', compact('total_product', 'active_product', 'inactive_product', 'total_customer', 'category', 'brand', 'coupon', 'visitor_count', 'review', 'subcriber', 'pending_order', 'received_order', 'complete_order', 'latest_order'));
    }


    //admin logout
    function AdminLogout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    //admin password change
    function AdminPasswordChange()
    {
        // $admin_info = DB::table('users')->where(Auth::user);

        return view('admin.password.index');
    }


    // update admin password
    function AdminPasswordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin_info = DB::table('users')->where('id', Auth::user()->id)->first();

        if (Hash::check($request->old_password, $admin_info->password)) {

            $newpassword = Hash::make($request->new_password);

            DB::table('users')->where('id', $admin_info->id)->update(['password' => $newpassword]);

            $notification = array('message' => 'password updated', 'alert-type' => 'success');

            return redirect()->back()->with($notification);
        } else {

            $notification = array('message' => 'You have entered wrong Password!', 'alert-type' => 'warning');

            return redirect()->back()->with($notification);
        }
    }
}
