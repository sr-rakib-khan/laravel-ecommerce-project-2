<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('index');
            }
        } else {
            return redirect()->back()->with('error', 'your email or password are not valid');
        }
    }

    function AdminLogin()
    {
        return view('admin.admin_login');
    }


    function AdminSignup(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $request->email, 'password' => $request->password))) {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'your email or password are not valid');
        }
    }


    function UserLogin()
    {
        return view('auth.login');
    }


    // sign up page show 
    function Signup()
    {
        return view('auth.register');
    }


    function UserLogout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
