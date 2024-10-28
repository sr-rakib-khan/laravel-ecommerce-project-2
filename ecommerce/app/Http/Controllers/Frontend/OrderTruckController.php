<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrderTruckController extends Controller
{
    function OrderTruck()
    {
        $results = DB::table('orders')->where('user_id', Auth::user()->id)->get();
        return view('frontend.user.order_truck', compact('results'));
    }

    function OrderSearch(Request $request)
    {
        $query = $request->input('searchQuery');

        $results = DB::table('orders')
            ->where('order_id', 'like', "%{$query}%")
            ->get();
        return view('frontend.user.order_truck', compact('results'));
    }
}
