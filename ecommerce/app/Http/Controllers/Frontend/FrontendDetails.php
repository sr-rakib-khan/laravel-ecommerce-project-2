<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendDetails extends Controller
{
    function Info($id)
    {
        $details = DB::table('pages')->where('id', $id)->first();
        return view('frontend.footer_details', compact('details'));
    }
}
