<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\RegPosyandu;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
        
            // Cek role dan redirect sesuai role
           if ($user->role == 'admin' || $user->role == 'user') {
                Alert::success('Login Successful', 'Welcome back!');
                return redirect()->route('admin.dashboard');
            } else {
                // Logout jika peran tidak sesuai
                Auth::logout();
                Alert::error('Login Failed', 'You are not authorized to access this area.');
                return redirect('/');
            }
        }
        

        // Authentication failed
        Alert::error('Login Failed', 'The provided credentials do not match our records.');
        return back();
    }


    /**
     * Handle logout.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}