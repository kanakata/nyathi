<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompressResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if(extension_loaded("gzip")){
            dd();
            $content_type = $response->headers->get("Content-Type");
            if(is_string($content_type) && preg_match("/(text|json|javascript|xml)/i", $content_type)){
                $content = $response->getContent();
                $compressed_content = gzencode($content, 5);
                $response->setContent($compressed_content);
                $response->headers->set("Content-Encoding", "gzip");
                $response->headers->set("Vary","Accept-Encoding");
                $response->headers->set("Content-Length", strlen($compressed_content));
            }
        }
        return $response;
    }
}
