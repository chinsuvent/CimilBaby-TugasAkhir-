<?php



// app/Http/Middleware/CekLevelPengguna.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekLevelPengguna
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'Pengguna') {
            return $next($request);
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}

