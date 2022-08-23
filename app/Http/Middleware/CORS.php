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
        $allowedOrigins = ['https://secure-api-ui.herokuapp.com', 'http://localhost:4200'];
        $origin = request()->headers->get('origin');

        if(in_array($origin,$allowedOrigins)){
            header('Access-Control-Allow-Origin',$origin);
            header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
            header('Access-Control-Allow-Methods:  PUT, GET, HEAD, POST, DELETE, OPTIONS');

            if ($request->method() == "OPTIONS") {
                return $next($request)->setStatusCode(200);
            }
        }
        return $next($request);
    }

}
