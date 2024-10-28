<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function Index()
    {
        $message = DB::table('contacts')->get();
        return view('admin.message.index', compact('message'));
    }

    function View($id)
    {
        $message = DB::table('contacts')->where('id', $id)->first();
        return view('admin.message.view', compact('message'));
    }

    function Delete($id)
    {
        DB::table('contacts')->where('id', $id)->delete();
        $notification = array('message' => 'Message deleted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
    }

