<?php
namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
class CORS {

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        header('Access-Control-Allow-Origin:  *');
        header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
        header('Access-Control-Allow-Methods:  POST, PUT');

        if ($request->method() == "OPTIONS") {
            return $next($request)->setStatusCode(200);
        }

        return $next($request);
    }

}
