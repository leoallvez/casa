<?php

namespace Casa\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUsuario {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
      
        if (Auth::user()->nivel_id == 4 || Auth::user()->deleted_at != null) {
            Auth::logout();
            return redirect('login');
        }
        return $next($request);
    }
}
