<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logmasuk()
    {
        #kalau dah login akan redirect ke dashboard
        if (Auth::check()) {
            return redirect()->intended('admin/dashboard');
        }
        return view('logmasuk'); // login view kalau belum log  masuk
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Maklumat yang di masukkan tidak sah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

         // Redirect to login page
         return redirect()->route('logmasuk'); // Make sure this route matches your login route
    }
}
