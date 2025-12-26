<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Ambil role pengguna yang sedang login
        $userRole = auth()->user()->role;

        // Cek apakah role pengguna termasuk dalam daftar yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}