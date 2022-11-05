<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionNotAllowException;
use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Throw_;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $userPermissons = getPermissionFromPayload();

        $s = array_intersect($permissions, $userPermissons);

        if (count($s) === count($permissions)) {
            return $next($request);
        } else throw (new PermissionNotAllowException());

    }
}
