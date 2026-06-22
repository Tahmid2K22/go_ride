<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale'));

        if ($request->has('lang')) {
            $lang = $request->query('lang');
            if (in_array($lang, config('app.available'))) {
                Session::put('locale', $lang);
                $locale = $lang;
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}
