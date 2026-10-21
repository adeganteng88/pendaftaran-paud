<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login dan role-nya sesuai dengan yang diizinkan
        if (Auth::check() && in_array(Auth::user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, tendang balik atau tampilkan error
        return redirect('/')->with('error', 'Kamu tidak punya akses ke halaman ini!');
    }
}