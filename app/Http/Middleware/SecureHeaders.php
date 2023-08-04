<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecureHeaders
{
    public function handle(Request $request, Closure $next)
    {
        /**@var Response $response*/
        $response = $next($request);

        $response->headers->add(config('secure-headers.include'));

        foreach (config('secure-headers.exclude') as $header) {
            header_remove($header);
        }

        return $response;
    }
}
