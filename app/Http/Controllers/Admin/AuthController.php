<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    private $user;

    public function __construct()
    {
 
        $this->user = new User; 
    }
   
    public function index()
    {
        return view('admin-views.pages.auth.login'); 
    }
    public function logout()
    {
        
        Auth::logout();

        return redirect()->back();
    }
    public function login(Request $request){
       

        $request->validate([
            'email' =>'required|min:6',
            'password' =>'required|min:6'
        ], [
            'username.required' =>'Tên đăng nhập không được để trống',
            'username.min' => 'Tên đăng nhập chứa tối thiểu :min ký tự',
            'password.required' =>'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu chứa tối thiểu :min ký tự'
        ]);
        if(Auth::attempt([
            'email' =>$request->input('email'),
            'password' =>$request->input('password'),
            /* 'role' => 1 */ ])
        ){
            dd(123);
        }
        else {
            session()->flash('error', 'Email hoặc mật khẩu không chính xác');
            return redirect()->back();
        }
        
    }
    
}





