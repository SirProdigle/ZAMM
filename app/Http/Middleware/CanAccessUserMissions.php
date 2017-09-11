<?php

namespace App\Http\Middleware;

use Closure;

class CanAccessUserMissions
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
        if($request->user()->id == $request->id || $request->user()->IsRoleOrAbove('Game Admin'))
            return $next($request);
        else
           return redirect("/");
    }
}
