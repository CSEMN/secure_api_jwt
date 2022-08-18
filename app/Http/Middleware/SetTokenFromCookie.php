<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetTokenFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->cookie('token')){
            $request->headers->set('Authorization', $request->cookie('token'));
        }
        return $next($request);
    }
}
