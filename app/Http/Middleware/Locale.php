<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;

class Locale
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
        app()->setLocale(
            Session::get('locale', Config::get('app.locale'))
        );

        return $next($request);
    }
}
