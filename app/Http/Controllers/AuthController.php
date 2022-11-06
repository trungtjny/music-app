<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
            $user =  User::create($request->only('email', 'name', 'password'));
            $user->roles()->sync(2);

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function resetPassword()
    {
    }

    public function updateAccount()
    {
    }
}
