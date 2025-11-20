<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterMiddleware
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
        // Periksa apakah pengguna sudah login DAN memiliki peran 'dokter'
        if (Auth::check() && Auth::user()->role === 'dokter') {
            return $next($request);
        }

        // Jika tidak, tolak akses
        Auth::logout(); // Logout paksa untuk keamanan
        return redirect('/')->with('error', 'Akses ditolak. Anda bukan dokter.');
    }
}