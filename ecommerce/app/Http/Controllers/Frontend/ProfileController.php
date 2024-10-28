<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;




class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function Dashborad()
    {
        $recent_order = DB::table('orders')->orderBy('id','DESC')->where('user_id', Auth::user()->id)->get();

        $total_order = DB::table('orders')->where('user_id', Auth::user()->id)->count();

        $order_done = DB::table('orders')->where('user_id', Auth::user()->id)->where('status', 3)->count();

        $received_order = DB::table('orders')->where('user_id', Auth::user()->id)->where('status', 1)->count();

        $order_pending = DB::table('orders')->where('user_id', Auth::user()->id)->where('status', 0)->count();

        return view('frontend.user.dashboard', compact('total_order', 'order_done', 'received_order', 'order_pending', 'recent_order'));
    }

    function UserSettings()
    {
        return view('frontend.user.user_settings');
    }

    // shipping store method 
    function ShippingStore(Request $request)
    {
        $shipping = array();
        $shipping['user_id'] = Auth::id();
        $shipping['shipping_name'] = $request->name;
        $shipping['shipping_phone'] = $request->phone;
        $shipping['shipping_email'] = $request->email;
        $shipping['shipping_address'] = $request->address;
        $shipping['shipping_country'] = $request->country;
        $shipping['shipping_city'] = $request->city;
        $shipping['shipping_zipcode'] = $request->zipcode;

        if ($request->photo) {
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $photo = $request->photo;
            $photo_read = $manager->read($photo);
            $photo_name = $slug . "." . $photo->getClientOriginalExtension();
            $photo_resize = $photo_read->resize(300, 300)->save('public/files/profile/' . $photo_name);

            $shipping['photo'] = 'public/files/profile/' . $photo_name;
        }

        DB::table('shippings')->insert($shipping);
        $notification = array('message' => 'Shipping Address Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    //user password change method
    function UserPasswordChange(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);


        $current_password = Auth::user()->password;
        $old_password = $request->old_password;
        if (Hash::check($old_password, $current_password)) {
            $user = User::findorfail(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            $notification = array('message' => 'Password Changed', 'alert-type' => 'success');
            return
                redirect()->back()->with($notification);
        } else {
            $notification = array('message' => 'Old Password not matched', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }
}
