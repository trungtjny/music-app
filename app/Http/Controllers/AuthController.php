<?php

namespace App\Http\Controllers;

use App\Events\VerifyAccountEvent;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
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
            $user->roles()->sync(4);

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

    public function updateAccount(Request $request)
    {
        User::findOrFail(Auth::id())->update($request->all());
    }

    public function HandleVerify(Request $request)
    {
        $status = $request->status;
        $user = User::findOrFail($request->id);
        if ($status) {
            event(new VerifyAccountEvent($user));
        }
    }

    public function ListVerify()
    {
        return User::where('active', 0)->with(['roles' => function ($query) {
            $query->where('name', 'singer');
        }])->get();
    }

    public function ShowVerify($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }
}
