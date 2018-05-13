<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNurse
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'nurse')
	{
        if($request->is('nurse/register')){
            return $next($request);
        }
	    else if($request->is('nurse/password/reset')){
            return $next($request);

        }
	    else if (Auth::guard($guard)->check()) {
	        return redirect('nurse/home');
	    }

	    return $next($request);
	}
}