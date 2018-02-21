<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Support\Facades\Auth;

class adminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if($request->user()->userRole == 2) {
                return redirect('/admin');
            }
           
                return $next($request);
           
            
        }

        if(Auth::guest())
        {
            return redirect('/Restricted');
        }
    }
}
