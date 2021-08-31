<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * [handle an incoming request]
     * @param  \Illuminate\Http\Request  $request [will hold the request body and headers]
     * @param  Closure $next    [description]
     * @param  [Role]  $role    [will hold the roles of the requesting user]
     * @return [closure]           [description]
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if(!auth()->check()){
            return redirect('login');
        }
        
        // dd($roles);

        if (! $request->user()->hasAnyRole($roles)) {
            abort(401, 'This action is unauthorized. Contact Admin.');
        }
        return $next($request);
    }
}
