<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika user belum login
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Silahkan login terlebih dahulu!');
        }

        // Ambil role user
        $userRole = Auth::user()->role;

        // Cek apakah role user termasuk ke dalam role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Jika tidak sesuai role
        return abort(403);
    }

}
