<?php

namespace Vendor\UltimateStarterKit\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user is super admin
        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return $next($request);
        }

        $routeName = Route::currentRouteName();

        // If route has no name, allow (graceful degradation)
        if (!$routeName) {
            return $next($request);
        }

        // Check if user has permission
        if (method_exists($user, 'hasPermission') && $user->hasPermission($routeName)) {
            return $next($request);
        }

        // Permission denied
        abort(403, 'You do not have permission to access this resource.');
    }
}

