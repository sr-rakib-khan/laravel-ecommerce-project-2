<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    //role index method
    function IndexRole()
    {
        $role = DB::table('users')->where('is_admin', 1)->orWhere('role_admin', 1)->get();

        return view('admin.role.index',  compact('role'));
    }

    //role create method
    function CreateRole()
    {
        return view('admin.role.create');
    }

    //role store method
    function StoreRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $role = array();
        $role['name'] = $request->name;
        $role['email'] = $request->email;
        $role['phone'] = $request->phone;
        $role['password'] = Hash::make($request->password);
        $role['role_admin'] = $request->role_type;
        $role['category'] = $request->category;
        $role['brand'] = $request->brand;
        $role['product'] = $request->product;
        $role['order'] = $request->order;
        $role['offer'] = $request->offer;
        $role['blog'] = $request->blog;
        $role['report'] = $request->report;
        $role['settings'] = $request->settings;
        $role['userrole'] = $request->userrole;

        DB::table('users')->insert($role);

        $notification = array('message' => 'Role Inserted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //reole delete method
    function DeleteRole($id)
    {
        DB::table('users')->where('id', $id)->delete();
        $notification = array('message' => 'Role deleted!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    //edit role mehtod
    function EditRole($id)
    {
        $role = DB::table('users')->where('id', $id)->first();

        return view('admin.role.edit', compact('role'));
    }


    //update role mehtod
    function UpdateRole(Request $request)
    {
        $role = array();
        $role['name'] = $request->name;
        $role['email'] = $request->email;
        $role['phone'] = $request->phone;
        $role['role_admin'] = $request->role_type;
        $role['category'] = $request->category;
        $role['brand'] = $request->brand;
        $role['product'] = $request->product;
        $role['order'] = $request->order;
        $role['offer'] = $request->offer;
        $role['blog'] = $request->blog;
        $role['report'] = $request->report;
        $role['settings'] = $request->settings;
        $role['userrole'] = $request->userrole;

        DB::table('users')->where('id', $request->id)->update($role);

        $notification = array('message' => 'Role Updated!', 'alert-type' => 'success');

        return redirect()->route('index.role')->with($notification);
    }
}
