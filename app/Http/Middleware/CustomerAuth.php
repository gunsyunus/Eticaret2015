<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Auth;

class CustomerAuth
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
        if (Auth::guest() or Auth::user()->role != 2) {
            return Redirect::action('Site\CustomerController@index');
        }

        return $next($request);
    }
}
