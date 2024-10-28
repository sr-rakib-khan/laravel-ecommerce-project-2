<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
  function __construct()
  {
    $this->middleware('auth');
  }

  function OrderReportIndex(Request $request)
  {
    if ($request->ajax()) {
      $orders = "";

      $query = DB::table('orders')->orderBy('id', 'DESC');
      if ($request->date) {
        $date_formate = date('d-m-y', strtotime($request->date));

        $query->where('date', $date_formate);
      }
      if ($request->payment_type == "cash on delivery") {
        $query->where('payment_type', "cash on delivery");
      }
      if ($request->payment_type == "mobile banking") {
        $query->where('payment_type', "mobile banking");
      }
      if ($request->status == "all") {
        $query->where('status', 0)->orWhere('status', 1)->orWhere('status', 2)->orWhere('status', 3)->orWhere('status', 4)->orWhere('status', 5);
      }
      if ($request->status == 0) {
        $query->where('status', 0);
      }
      if ($request->status == 1) {
        $query->where('status', 1);
      }
      if ($request->status == 2) {
        $query->where('status', 2);
      }
      if ($request->status == 3) {
        $query->where('status', 3);
      }
      if ($request->status == 4) {
        $query->where('status', 4);
      }
      if ($request->status == 5) {
        $query->where('status', 5);
      }

      $orders = $query->get();

      return DataTables::of($orders)->addIndexColumn()
        ->editColumn(
          'status',
          function ($row) {
            if ($row->status == 0) {
              return '<span class="badge badge-danger">Order pending</span>';
            } elseif ($row->status == 1) {
              return '<span class="badge badge-success">Order received</span>';
            } elseif ($row->status == 2) {
              return '<span class="badge badge-primary">Order Shipped</span>';
            } elseif ($row->status == 3) {
              return '<span class="badge badge-success">Order Completed</span>';
            } elseif ($row->status == 4) {
              return '<span class="badge badge-warning">Order return</span>';
            } else {
              return '<span class="badge badge-danger">Order cancled</span>';
            }
          }
        )
        ->rawColumns(['status'])->make(true);
    }
    return view('admin.report.order report.index');
  }


  function OrderReportPrint(Request $request)
  {
    if ($request->ajax()) {
      $orders = "";

      $query = DB::table('orders')->orderBy('id', 'DESC');
      if ($request->date) {
        $date_formate = date('d-m-y', strtotime($request->date));

        $query->where('date', $date_formate);
      }
      if ($request->payment_type == "cash on delivery") {
        $query->where('payment_type', "cash on delivery");
      }
      if ($request->payment_type == "mobile banking") {
        $query->where('payment_type', "mobile banking");
      }
      if ($request->status == "all") {
        $query->where('status', 0)->orWhere('status', 1)->orWhere('status', 2)->orWhere('status', 3)->orWhere('status', 4)->orWhere('status', 5);
      }
      if ($request->status == 0) {
        $query->where('status', 0);
      }
      if ($request->status == 1) {
        $query->where('status', 1);
      }
      if ($request->status == 2) {
        $query->where('status', 2);
      }
      if ($request->status == 3) {
        $query->where('status', 3);
      }
      if ($request->status == 4) {
        $query->where('status', 4);
      }
      if ($request->status == 5) {
        $query->where('status', 5);
      }

      $orders = $query->get();
    }
    return view('admin.report.order report.report',compact('orders'));
  }
}
