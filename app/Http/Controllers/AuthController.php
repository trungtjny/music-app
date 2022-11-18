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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = JWTAuth::attempt($request->only('email', 'password'));
            $user = User::findOrFail(Auth::id());
            $user['permissions'] = getPermissionFromPayload($user->id); 
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

    public function getme()
    {
        $user = User::findOrFail(Auth::id());
        $user['permissions'] = getPermissionFromPayload($user->id); 
        return $user;
    }
    public function register(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $input = $request->only('email', 'name', 'password', 'address', 'date_of_birth');
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatqar');
                $type = $request->file('avatar')->extension();
                $image_name = time() . '-avatar.' . $type;
                $path = Storage::disk('local')->put('/public/user/avatar/' . $image_name, $image->getContent());
                $input['avatar'] = 'storage/user/avatar/' . $image_name;
            }
            $user =  User::create($input);
            $user->roles()->sync($request->role);

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

    public function update(Request $request)
    {
        $input = $request->only('email', 'name', 'password', 'address', 'date_of_birth', 'avatar');
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatqar');
            $type = $request->file('avatar')->extension();
            $image_name = time() . '-avatar.' . $type;
            $path = Storage::disk('local')->put('/public/user/avatar/' . $image_name, $image->getContent());
            $input['avatar'] = 'storage/user/avatar/' . $image_name;
        }
        User::findOrFail(Auth::id())->update($input);
    }

    public function HandleVerify(Request $request)
    {
        $status = $request->status;
        $user = User::findOrFail($request->id);
        if ($status) {
            $user->active = 1;
            $user->update(['active' => 1]);
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
