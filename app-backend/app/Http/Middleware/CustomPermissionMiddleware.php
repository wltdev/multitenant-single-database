<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CustomPermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        $user = $authGuard->user();

        // Debug information
        \Log::info('User Permissions Check', [
            'user_id' => $user->id,
            'required_permissions' => $permissions,
            'user_permissions' => $user->getAllPermissions()->pluck('name'),
            'user_roles' => $user->getRoleNames(),
        ]);

        if (!$user->canAny($permissions)) {
            throw UnauthorizedException::forPermissions($permissions);
        }

        return $next($request);
    }
}
