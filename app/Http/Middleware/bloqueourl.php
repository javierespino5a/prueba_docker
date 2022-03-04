<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class bloqueourl
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

        if(empty(Session::get('user')))
        {
            return redirect('/');  
        }
        return $next($request);
    }
}
