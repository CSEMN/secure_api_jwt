<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ForceJsonOnAPIs
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
        // Force Json accept type on api routes
        if ($request->is('api/*') && !Str::contains($request->header('accept'), ['/json', '+json'])) {
            $request->headers->set('accept', 'application/json,' . $request->header('accept'));
        }

        return $next($request);
    }
}
