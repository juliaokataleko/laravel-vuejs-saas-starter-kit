<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->level != 'admin' && auth()->user()->business)
            return $next($request);

        if (auth()->check() && auth()->user()->level != 'admin') {
            if (!request()->routeIs('business.settings.create') && !request()->routeIs('business.settings.store')) {
                return redirect(route('business.settings.create'))->with('sucess', 'Please informe your company data');
            }
        }

        return $next($request);
    }
}
