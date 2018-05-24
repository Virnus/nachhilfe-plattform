<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Testet ob der benutzer die verlangten Rollen hat
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $role2 = '')
    {
        if (! $request->user()->hasRole($role) && !$request->user()->hasRole($role2)) {
            return redirect()->route('home')
                ->withError('Access Denied');
        }

        return $next($request);
    }
}
