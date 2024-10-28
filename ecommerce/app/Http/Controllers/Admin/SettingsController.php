<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class SettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function Websiteindex()
    {
        $setting = DB::table('settings')->first();
        return view('admin.settings.website.index', compact('setting'));
    }

    function WebsiteUpdate(Request $request)
    {
        $settings = array();
        $settings['phone_one'] = $request->phone_one;
        $settings['phone_two'] = $request->phone_two;
        $settings['main_email'] = $request->main_email;
        $settings['support_email'] = $request->support_email;
        $settings['favicon'] = $request->favicon;
        $settings['address'] = $request->address;
        $settings['facebook'] = $request->facebook;
        $settings['twitter'] = $request->twitter;
        $settings['instagram'] = $request->instagram;
        $settings['linkedin'] = $request->linkedin;
        $settings['youtube'] = $request->youtube;

        if ($request->hasFile('logo')) {
            $old_logo = $request->old_logo;
            if (File::exists($old_logo)) {
                unlink($old_logo);
            }
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $logo = $request->logo;
            $logo_read = $manager->read($logo);
            $logo_name = $slug . "." . $logo->getClientOriginalExtension();
            $logo_resize = $logo_read->resize(300, 300)->save('public/files/settings/' . $logo_name);
            $settings['logo'] = 'public/files/settigns/' . $logo_name;
        } else {
            $settings['logo'] = $request->old_logo;
        }

        if ($request->hasFile('favicon')) {
            $old_favicon = $request->old_favicon;
            if (File::exists($old_favicon)) {
                unlink($old_favicon);
            }
            $slug = uniqid();
            $manager = new ImageManager(new Driver());
            $favicon = $request->favicon;
            $favicon_read = $manager->read($favicon);
            $favicon_name = $slug . "." . $favicon->getClientOriginalExtension();
            $favicon_resize = $favicon_read->resize(300, 300)->save('public/files/settings/' . $favicon_name);
            $settings['favicon'] = 'public/files/settigns/' . $favicon_name;
        } else {
            $settings['favicon'] = $request->old_favicon;
        }

        DB::table('settings')->where('id', $request->id)->update($settings);
        $notification = array('message' => 'Settings Updated', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    // mail index page 
    function MailIndex()
    {
        $mail = DB::table('mails')->first();
        return view('admin.settings.mail.index', compact('mail'));
    }

    // mail update method 
    function MailUpdate(Request $request)
    {
        $mail = array();
        $mail['mailer'] = $request->mailer;
        $mail['host'] = $request->host;
        $mail['port'] = $request->port;
        $mail['user_name'] = $request->user_name;
        $mail['password'] = $request->password;

        DB::table('mails')->where('id', $request->mail_id)->update($mail);

        $notification = array('message' => 'mail Setting updated', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }


    //page index mehtod
    function PageIndex()
    {
        $page = DB::table('pages')->get();
        return view('admin.settings.pages.index', compact('page'));
    }

    //page create mehod
    function PageCreate()
    {
        return view('admin.settings.pages.create');
    }

    //page store method
    function PageStore(Request $request)
    {
        $page = array();
        $page['page_positon'] = $request->page_position;
        $page['page_name'] = $request->page_name;
        $page['page_title'] = $request->page_title;
        $page['page_description'] = $request->page_description;

        DB::table('pages')->insert($page);
        $notification = array('message' => 'Page Inserted', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //page edit mehtod
    function PageEdit($id)
    {
        $page = DB::table('pages')->where('id', $id)->first();
        return view('admin.settings.pages.edit', compact('page'));
    }

    // page update method
    function PageUpdate(Request $request)
    {
        $page = array();
        $page['page_positon'] = $request->page_position;
        $page['page_name'] = $request->page_name;
        $page['page_title'] = $request->page_title;
        $page['page_description'] = $request->page_description;

        DB::table('pages')->where('id', $request->page_id)->update($page);

        $notification = array('message' => 'Page info updated!', 'alert-type' => 'success');

        return redirect()->route('admin.page.index')->with($notification);
    }

    //page delete method
    function PageDelete($id)
    {
        DB::table('pages')->where('id', $id)->delete();
        return redirect()->back();
    }
}
