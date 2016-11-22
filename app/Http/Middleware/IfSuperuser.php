<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IfSuperuser
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
        if(Auth::check())
        {
            if(! Auth::user()->superuser)
            {
                return redirect()->route('previous');
            }
            return $next($request);
        }
        else
        {
            return redirect()->route('previous');
        }
    }
}
