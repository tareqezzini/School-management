<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next)
    {
        if(auth('web')->check())
        {
            return Redirect(RouteServiceProvider::HOME);
        }
        if(auth('teacher')->check())
        {
            return Redirect(RouteServiceProvider::TEACHER);
        }
        if(auth('student')->check())
        {
            return Redirect(RouteServiceProvider::STUDENT);
        }
        if(auth('parent')->check())
        {
            return Redirect(RouteServiceProvider::PARENT);
        }

        return $next($request);
    }
}