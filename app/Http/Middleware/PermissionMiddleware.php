<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null, $guard = null): Response
    {
        $authGuard = app('auth')->guard($guard);
        if ($authGuard->guest())
        {
            throw UnauthorizedException::notLoggedIn();
        }
        // Check If current Route is Exempted In the Middleware
        if ($this->exemptedRoutes($request))
        {
            return $next($request);
        }
        // Check If permission is passed on the routes
        if (!is_null($permission))
        {
            $permissions = is_array($permission)
                ? $permission
                : explode('|', $permission);
        }
        // Check if permission is null
        if (is_null($permission) ) {
            // get the route name
            $permission = $request->route()->getName();
            // Add the permission to the array
            $permissions = array($permission);
        }
        foreach ($permissions as $permission) {
            // check is the user has that permission to visit the route
            if ($authGuard->user()->can($permission)) {
                // Proceed if the permission is granted
                return $next($request);
            }
        }
        // return a 403 response if the permission is not granted
//        return \response()->json(["success" => false,'message' => 'Unauthorized'], 403);
        throw UnauthorizedException::forRolesOrPermissions([$permission]);
    }

    private function exemptedRoutes(Request $request): bool
    {
        $routeName = $request->route()->getName();
        // Exempted Routes
        $exemptedRoutes = ['download.user','login', 'register', 'password.request', 'password.reset', 'password.confirm', 'password.email', 'verification.send', 'verification.verify', 'verification.resend', 'sanctum.csrf-cookie', 'dark-mode-switcher', 'color-scheme-switcher', 'password.update', 'logout', 'verification.notice'];
        return in_array($routeName, $exemptedRoutes);
    }
}
