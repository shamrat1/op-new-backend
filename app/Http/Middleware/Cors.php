<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class Cors
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
        // return response()->json("from cors");
        // header("Access-Control-Allow-Origin: *");
        //ALLOW OPTIONS METHOD
        // $headers = [
        //     'Access-Control-Allow-Origin' => '*',
        //     'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,DELETE',
        //     'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
        // ];
        // if ($request->isMethod('OPTIONS')){
        //     $response = Response::make();
        // } else {
        //     $response = $next($request);
        // }
        // foreach ($headers as $key => $value) {
        //     $response->header($key, $value);
        // }
        // return $response;
        if ($request->isMethod('OPTIONS')){
            $response = Response::make();
        } else {
            $response = $next($request);
        }
        return $response
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Allow-Headers', '*');
    }
}
