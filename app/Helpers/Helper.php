<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


if (!function_exists('responseSuccess')) {
    function responseSuccess($data, $message = "Request Success")
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ]);
    }
}

if (!function_exists('getPermissionFromPayload')) {
    function getPermissionFromPayload()
    {
        $user =  User::findOrFail(Auth::id());

        $user->load(['roles.permissions']);

        $permissions = [];

        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }
}
