<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $role = strtolower(trim($user->role ?? ''));

        // Samakan penulisan alias role yang digunakan sistem.
        $role = match ($role) {
            'admin' => 'admin',
            'waka' => 'waka',
            'guru' => 'guru',
            'kepsek' => 'kepala_sekolah',
            default => $role,
        };

        $allowedRoles = array_map(
            fn ($item) => strtolower(trim($item)),
            $roles
        );

        if (!in_array($role, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}