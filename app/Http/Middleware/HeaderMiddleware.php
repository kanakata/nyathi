<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $response =  $next($request);
        if(function_exists("header_remove")){
            header_remove("X-Powered-By");
        }
        $response->headers->set('Cache-Control', 'max-age=3600, public');
        $response->headers->set('Cross-Origin-opener-Policy', 'same-origin');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('Cache-Control', 'max-age=3600, public');
        $csp = "default-src 'self'; "."script-src 'self' 'unsafe-inline'; "."style-src 'self' 'unsafe-inline'; "."font-src 'self' https://google.com; "."img-src 'self' data:; "."require-trusted-types-for 'script' ;";
        $response->headers->set('Content-Security-Policy', $csp);
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=63072000; includeSubDomains; preload');
        }

        return $response;
    }
}
