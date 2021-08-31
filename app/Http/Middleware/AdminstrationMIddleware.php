<?php

namespace App\Http\Middleware;

use Closure;

class AdminstrationMIddleware
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
        if ($request->user() && $request->user()->hasAnyRole(['Admin','Editor','Moderator']) != true)
        {
            return new Response(view(‘unauthorized’)->with(‘role’, ‘ADMIN’));
        }

        return $next($request);
    }
}
