<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HierarchyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $level)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userLevel = auth()->user()->role_id;   // 0, 1, or 2

        // If user role is higher (number is bigger), deny access
        if ($userLevel > $level) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }

}
