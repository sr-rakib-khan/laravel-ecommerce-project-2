<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class ReviwController extends Controller
{

    function ReviewStore(Request $request)
    {
        $review = array();
        $review['user_id'] = Auth::id();
        $review['product_id'] = $request->product_id;
        if ($request->name == null) {
            $review['name'] = Auth::user()->name;
        } else {
            $review['name'] = $request->name;
        }

        if ($request->email == null) {
            $review['email'] = Auth::user()->email;
        } else {
            $review['email'] = $request->email;
        }

        if ($request->phone == null) {
            $review['phone'] = Auth::user()->phone;
        } else {
            $review['phone'] = $request->phone;
        }
        $review['star'] = $request->star;
        $review['review'] = $request->review;


        if (auth()->check()) {
            DB::table('reviews')->insert($review);
            $notification = array('message' => 'Review Inserted', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $notification = array('message' => 'At first You have to login', 'alert-type' => 'warning');
            return redirect()->back()->with($notification);
        }
    }
}
