<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class CreatorOnly
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

        $product = Product::find($request->product);
        if ($product) {
            if (auth()->id() == $product->user->id)
                return $next($request);
            else
                return response(
                    ['error' => 'Only Product creator can update or delete'], 403
                );
        } else {
            return response(
                [
                    'status'=>'404',
                    'error' => 'Product not found'
                ], 404
            );
        }

    }
}
