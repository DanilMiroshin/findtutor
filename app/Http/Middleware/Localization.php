<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Localization
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
        $locale = 'ru';

        if (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        
        app()->setLocale($locale);
        return $next($request);
    }
}
