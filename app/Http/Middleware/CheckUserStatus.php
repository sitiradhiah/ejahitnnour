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
        if (Auth::check() && (Auth::user()->status === 'tidak aktif' || Auth::user()->disahkan != 1)) {
            Auth::logout();
            return redirect()->route('logmasuk')->with('message', 'Akaun anda belum disahkan atau anda tidak aktif sebagai pengguna sistem.');
        }

        return $next($request);
    }
}
