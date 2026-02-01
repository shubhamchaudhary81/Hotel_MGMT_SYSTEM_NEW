<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccessMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Only super admin or staff can access admin routes
        if (!$user->is_super_admin && !$user->staff) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
