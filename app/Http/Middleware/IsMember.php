<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsMember
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
        if(Auth::user()->id_admin == 1){
            return redirect()->back();
        }
        return $next($request);
    }
}
