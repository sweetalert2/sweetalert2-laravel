<?php declare(strict_types=1);

namespace SweetAlert2\Laravel\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use SweetAlert2\Laravel\Swal;

/**
 * Laravel SweetAlert2 Inertia Middleware {@see https://github.com/sweetalert2/sweetalert2-laravel}
 * 
 * This middleware shares SweetAlert2 flash data with Inertia.js responses.
 * 
 * @package SweetAlert2\Laravel\Middleware
 * @see https://sweetalert2.github.io
 */
class ShareInertiaFlashData
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        Inertia::share([
            'flash' => fn () => array_filter([
                Swal::SESSION_KEY => session(Swal::SESSION_KEY),
            ]),
        ]);

        return $next($request);
    }
}
