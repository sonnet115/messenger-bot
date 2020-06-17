<?php

namespace App\Http\Middleware;

use Closure;

class VerifyShopID
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('SHOP_UNIQUE_ID') !== 'dm-1001') {
            return redirect('/');
        }
        return $next($request);
    }
}
