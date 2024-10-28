<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use DateTime;


class OrderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    //order index method
    function Index(Request $request)
    {
        if ($request->ajax()) {
            // $data = product::latest()->get();
            $imageurl = 'public/files/product';
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
                    'Status',
                    function ($row) {
                        if ($row->status == 0) {
                            return 'span class="badge badge-danger">Order pending</span>';
                        } elseif ($row->status == 1) {
                            return 'span class="badge badge-primary">Order received</span>';
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
                )->addColumn('action', function ($row) {
                    $actionbtn = '<a href="' . route('admin.order.edit', [$row->id]) . '" class="btn btn-info btn-sm edit"
                    data-bs-toggle="modal" data-bs-target="#ordereditModal"><i class="fa-regular fa-pen-to-square"></i></a>
                    
                <a href="' . route('admin.order.view', [$row->id]) . '" class="btn btn-primary btn-sm view" data-bs-toggle="modal" data-bs-target="#orderviewModal"><i class="fa-regular fa-eye"></i></a>
                
                <a href="' . route('admin.order.delete', [$row->id]) . '" class="btn btn-info btn-sm btn-danger delete"><i class="fa-solid fa-trash"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action', 'Status'])->make(true);
        }
        return view('admin.order.index');
    }


    function Edit($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();
        return view('admin.order.edit', compact('order'));
    }

    function Update(Request $request)
    {
        $order_update = array();
        $order_update['f_name'] = $request->name;
        $order_update['phone'] = $request->phone;
        $order_update['address'] = $request->address;
        $order_update['status'] = $request->status;

        DB::table('orders')->where('id', $request->id)->update($order_update);

        return response()->json('Order Updated');
    }


    function View($id)
    {
        $order_details = DB::table('orders')->join('orders_details', 'orders.id', 'orders_details.order_id')->where('orders.id', $id)->select('orders.*', 'orders_details.*')->first();

        return view('admin.order.view', compact('order_details'));
    }

    function Delete($id)
    {
        DB::table('orders')->where('id', $id)->delete();

        return response()->json('Order Deleted');
    }
}
