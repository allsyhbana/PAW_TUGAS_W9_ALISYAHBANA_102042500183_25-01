<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Pastikan pengguna login dan role-nya termasuk daftar role yang diizinkan.
     * Contoh pemakaian: role:admin  atau  role:admin,dosen
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Pastikan pengguna sudah login (autentikasi)
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // 2. Pastikan role pengguna diizinkan (otorisasi)
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Anda tidak memiliki hak akses!');
        }

        // 3. Lanjutkan request
        return $next($request);
    }
}
