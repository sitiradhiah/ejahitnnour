<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
            $user = Auth::user();

            if ($user->peranan === 'pelanggan') {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Anda tidak mempunyai kebenaran untuk log masuk ke dalam sistem.');
            }

            if ($user->status === 'tidak aktif' || $user->disahkan != 1) {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Akaun anda belum disahkan atau anda tidak aktif sebagai pengguna sistem.');
            }

            // ✅ Set version tracking after successful login
            $version = now()->timestamp;
            session(['peranan_version' => $version]);
            Cache::put('peranan_version_' . $user->id, $version);

            return redirect()->intended('admin/dashboard');
        }

        return redirect()->route('logmasuk')->withErrors([
            'email' => 'Maklumat yang dimasukkan tidak sah.',
        ])->withInput($request->only('email'));
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget('peranan_version');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

         // Redirect to login page
         return redirect()->route('logmasuk'); // Make sure this route matches your login route
    }
}
