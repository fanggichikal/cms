<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    //  */

    // public function handle(Request $request, Closure $next)
    // {
    //     $user = $request->user();

    //     // Pastikan pengguna sudah login dan perannya adalah admin atau user
    //     if ($user && ($user->access === 'admin' || $user->access === 'user')) {
    //         return $next($request);
    //     }

    //     // Jika tidak memiliki izin, kembalikan respon tidak diizinkan
    //     abort(403, 'Unauthorized action.');
    // }
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->access === 'admin') {
            return $next($request);
        }

        return redirect('/dashboard')->with('error', 'You do not have admin access');
    }
}
