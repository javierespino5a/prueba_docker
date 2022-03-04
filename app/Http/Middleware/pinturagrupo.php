<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class pinturagrupo
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

        if(Session::get('rol')==3 ||Session::get('rol')==2 || Session::get('rol')==1 )
        {
            return $next($request);
        }
        return redirect('/inicio');  

    }
}
