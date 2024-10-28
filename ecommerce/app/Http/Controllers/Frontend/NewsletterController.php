<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    function Newsletter(Request $request)
    {
        $data = array();
        $data['email'] = $request->email;
        DB::table('newsletters')->insert($data);

        $notification = array('message' => 'Subscribed', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
