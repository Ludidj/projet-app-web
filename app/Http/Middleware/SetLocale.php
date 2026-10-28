<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    $local = $request->session()->get('locale', config('app.locale'));
    App::SetLocale(in_array($local, ['fr','en'], true) ? $local : 'fr');
        return $next($request);
    }
}
