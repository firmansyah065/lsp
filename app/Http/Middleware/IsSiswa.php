<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsSiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user login DAN memiliki role 'siswa'
        if (Auth::check() && Auth::user()->role === 'siswa') {
            return $next($request);
        }

        // Jika tidak, tolak akses
        abort(403, 'Akses Ditolak. Halaman ini khusus Siswa.');
    }
}