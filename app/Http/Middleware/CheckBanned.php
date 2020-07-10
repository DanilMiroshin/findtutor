<?php

namespace App\Http\Middleware;

use Closure;

class CheckBanned
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
        if (\Auth::check() && \Auth::user()->status->isBanned == 1){
            \Auth::logout();
            return redirect('/login')->with('message', 'Ваш аккаунт был заблокирован');
        }
        return $next($request);
    }
}
