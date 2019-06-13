<?php

namespace App\Http\Middleware;

use Closure;

class LocalizationMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (\Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));
        } else {
            $langs = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));
            if (!empty($langs) and $langs[0] == 'lv'){
                \App::setLocale('lv');
            } else {
                \App::setLocale('en');
            }
        }
        return $next($request);
    }

}
