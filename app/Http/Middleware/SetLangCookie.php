<?php

namespace App\Http\Middleware;

use Closure;
use http\Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SetLangCookie
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!$request->hasCookie('lang')) {
            if ($request->has('lang')) {
                $lang_val = $request->lang;
            } else {
                $lang_val = 'en';
            }
            cookie()->queue(cookie()->forever('lang', $lang_val));
        } else {
            if (
                $request->has('lang' ||
                    cookie('lang') != $request->lang)
            ) {
                cookie('lang',$request->lang);

            } else
                return $next($request);
        }
        return $next($request);


    }
}
