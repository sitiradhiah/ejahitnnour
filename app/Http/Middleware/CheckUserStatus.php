<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (Auth::check() && (Auth::user()->status === 'tidak aktif' || Auth::user()->disahkan != 1)) {
        //     Auth::logout();
        //     return redirect()->route('logmasuk')->with('message', 'Akaun anda belum disahkan atau anda tidak aktif sebagai pengguna sistem.');
        // }
        if (Auth::check()) {
            $user = Auth::user();

            // Step 1: Check if user role is 'pelanggan'
            if ($user->peranan === 'pelanggan') {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Anda tidak mempunyai kebenaran untuk log masuk ke dalam sistem.');
            }

            // Step 2: Check if user is inactive or not verified
            if ($user->status === 'tidak aktif' || $user->disahkan != 1) {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Akaun anda belum disahkan atau anda tidak aktif sebagai pengguna sistem.');
            }

            // All checks passed, allow user through
            return $next($request);
        }

        // If user is not authenticated at all
        return redirect()->route('logmasuk')->with('message', 'Sila log masuk terlebih dahulu.');
    }
}
