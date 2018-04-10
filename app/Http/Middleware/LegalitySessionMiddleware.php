<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

/**
 * Class LegalitySessionMiddleware
 *
 * Разлогирование пользователя, если не совпадает сессия
 * @package App\Http\Middleware
 */
class LegalitySessionMiddleware
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
        if (!Auth::user() || Auth::user()->session_id != session()->getID()){
            Auth::logout();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
