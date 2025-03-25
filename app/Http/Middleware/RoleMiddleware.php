<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role->name !== $role) {
            abort(403, 'Bu sahifaga kirish taqiqlangan!');
        }
        return $next($request);
    }
}
