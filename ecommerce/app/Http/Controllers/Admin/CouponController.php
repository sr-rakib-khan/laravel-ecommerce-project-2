<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\Couponnotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function Index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('coupons')->latest()->get();

            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $actionbtn = '<a href="" class="btn btn-info btn-sm editcoupon" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#editcouponModal"><i class="fa-regular fa-pen-to-square"></i>edit</a>
                <a href="' . route('coupon.delete', [$row->id]) . '" class="btn btn-danger btn-sm delete-coupon"><i class="fa-solid fa-trash"></i>delete</a>';
                return $actionbtn;
            })->rawColumns(['action'])->make(true);
        }
        return view('admin.coupon.index');
    }

    function Store(Request $request)
    {
        $coupon = array();
        $coupon['coupon_code'] = $request->code;
        $coupon['date'] = $request->date;
        $coupon['type'] = $request->type;
        $coupon['amount'] = $request->amount;
        $coupon['status'] = $request->status;
        DB::table('coupons')->insert($coupon);

        // mail send for coupon 
        $subscriber = DB::table('newsletters')->get();

        foreach ($subscriber as $row) {
            Mail::to($row->email)->send(new Couponnotification($coupon));
        }
        return response()->json('Coupon inserted');
    }

    function Edit($id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }

    function Update(Request $request)
    {
        $coupon = array();
        $coupon['coupon_code'] = $request->code;
        $coupon['type'] = $request->type;
        $coupon['amount'] = $request->amount;
        $coupon['status'] = $request->status;
        $coupon['date'] = $request->date;
        DB::table('coupons')->where('id', $request->id)->update($coupon);
        return response()->json('coupon updated');
    }

    function Destroy($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        return response()->json('coupon deleted');
    }
}
