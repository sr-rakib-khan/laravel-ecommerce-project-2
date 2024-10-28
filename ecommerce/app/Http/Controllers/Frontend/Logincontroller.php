<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Logincontroller extends Controller
{
    function UserLogout()
    {
        Auth::logout();
        return redirect()->route('login.page');
    }



    function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $register = array();
        $register['name'] = $request->name;
        $register['email'] = $request->email;
        $register['phone'] = $request->phone;
        $register['password'] = Hash::make($request->password);

        DB::table('users')->insert($register);

        return view('auth.login');
    }
}
