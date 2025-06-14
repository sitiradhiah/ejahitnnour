<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logmasuk()
    {
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

            if (Auth::user()->disahkan == 0) {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Akaun anda belum disahkan. Sila hubungi pentadbir.');
            }

            // Check if user is active
            if (Auth::user()->status !== 'aktif') {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Status anda tidak aktif. Sila hubungi pentadbir.');
            }

            return redirect()->intended('admin/dashboard');
        }

        // Redirect back to logmasuk with error message
        return redirect()->route('logmasuk')->withErrors([
            'email' => 'Maklumat yang dimasukkan tidak sah.',
        ])->withInput($request->only('email'));
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
