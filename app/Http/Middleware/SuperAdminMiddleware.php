<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'super_admin' role
        if (Auth::check() && Auth::user()->role === 'super_admin') {
            return $next($request);
        }

        // Force logout and redirect with an error message if unauthorized
        Auth::logout();
        return redirect('/')->withErrors(['error' => 'Akses ditolak. Anda bukan Super Admin.']);
    }
}
