<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    //  */

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Pastikan pengguna sudah login dan perannya adalah admin atau user
        if ($user && ($user->access === 'admin' || $user->access === 'user')) {
            return $next($request);
        }

        // Jika tidak memiliki izin, kembalikan respon tidak diizinkan
        abort(403, 'Unauthorized action.');
    }
}
