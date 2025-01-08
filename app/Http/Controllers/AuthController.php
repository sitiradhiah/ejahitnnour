<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the login credentials
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // Attempt to authenticate
        // if (Auth::attempt($credentials, $request->boolean('remember'))) {
        //     $request->session()->regenerate();

            // Redirect to the intended page after login
            // return redirect()->intended('dashboard');
        // }

        // Throw validation exception on failure
        // throw ValidationException::withMessages([
        //     'email' => __('The provided credentials do not match our records.'),
        // ]);
        return redirect()->route('admin.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
