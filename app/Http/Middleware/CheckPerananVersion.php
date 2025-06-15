<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CheckPerananVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $sessionVersion = session('peranan_version');
            $cachedVersion = Cache::get('peranan_version_' . $user->id);

            if ($sessionVersion !== $cachedVersion) {
                Auth::logout();
                return redirect()->route('logmasuk')->with('message', 'Peranan anda telah dikemas kini. Sila log masuk semula.');
            }
        }

        return $next($request);
    }
}
