<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    function Index()
    {
        return view('frontend.contact');
    }

    function Store(Request $request)
    {
        $contact = array();
        $contact['name'] = $request->name;
        $contact['email'] = $request->email;
        $contact['subject'] = $request->subject;
        $contact['message'] = $request->message;

        DB::table('contacts')->insert($contact);
        $notification = array('message' => 'Message sent!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
