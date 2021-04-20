<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public $roles = array('administrador', 'emprendedor', 'funcionario', 'entidad');
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if (Auth::check() && in_array(Auth::user()->rol, $roles))
            return $next($request);

        return redirect('/');
    }
}
