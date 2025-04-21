<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpgradeInsecureRequestsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Only add header for Filament routes (adjust as needed)
        if ($request->is('admin/*') || $request->is('filament/*')) {
            $response->header('Content-Security-Policy', 'upgrade-insecure-requests');
        }

        return $response;
    }
}
