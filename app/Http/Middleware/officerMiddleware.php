<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Support\Facades\Auth;

class officerMiddleware
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
        if($request->user()->userRole == 2) {
            // return redirect('/admin');
             return $next($request);
        }
        else
        {
            return $next($request);
        }
        


    if(Auth::guest())
    {
        return redirect('/Restricted');
    }
    }
}
