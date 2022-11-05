<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionNotAllowException;
use Closure;
use Illuminate\Http\Request;

class AnyPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $userPermissons = getPermissionFromPayload();

        foreach ($userPermissons as $permission) {
            if (in_array($permission, $permission)) {
                return next($request);
            }
        }
        throw (new PermissionNotAllowException());
    }
}
