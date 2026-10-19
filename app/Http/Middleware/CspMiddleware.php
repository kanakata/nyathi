<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CspMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $csp = "default-src 'self'; "."script-src 'self'; "."style-src 'self' 'unsafe-inline'; "."font-src 'self' https://google.com; "."img-src 'self' data:; ";
        $response->headers->set('Content-Security-Policy', $csp);
        return $response;
    }
}
