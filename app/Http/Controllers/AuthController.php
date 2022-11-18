<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = JWTAuth::attempt($request->only('email', 'password'));
            $user = User::findOrFail(Auth::id());
            $res = ['token' => $token, 'user' => $user];
            return responseSuccess($res);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();

        return responseSuccess([]);
    }

    public function register(CreateUserRequest $request)
    {
        $user =  User::create($request->only('email', 'name', 'password'));
        $user->roles()->sync(2);

        return $user;
    }

    public function resetPassword()
    {
    }

    public function updateAccount()
    {
    }
}
