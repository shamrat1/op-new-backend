<?php

namespace App\Http\Middleware;

use Closure;

class XMLHTTPHeaderMiddleware
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
        // $request->headers->set('X-Requested-With', 'XMLHttpRequest');
//         "Access-Control-Allow-Origin": "*", // Required for CORS support to work
//   "Access-Control-Allow-Credentials": true, // Required for cookies, authorization headers with HTTPS
//   "Access-Control-Allow-Headers": "Origin,Content-Type,X-Amz-Date,Authorization,X-Api-Key,X-Amz-Security-Token,locale",
//   "Access-Control-Allow-Methods": "POST, OPTIONS"
        // $request->headers->set('Access-Control-Allow-Origin', '*');
        // $request->headers->set('Access-Control-Allow-Credentials', 'true');
        // $request->headers->set('Access-Control-Allow-Headers', 'Origin,Content-Type,X-Amz-Date,Authorization,X-Api-Key,X-Amz-Security-Token,locale');
        // $request->headers->set('Access-Control-Allow-Methods', 'GET, HEAD, POST, OPTIONS');
        return $next($request);
    }
}
