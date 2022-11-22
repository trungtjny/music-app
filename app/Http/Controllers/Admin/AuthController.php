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



    public function login(Request $request){
       

        $request->validate([
            'email' =>'required|min:6',
            'password' =>'required|min:6'
        ], [
            'email.required' =>'Email không được để trống',
            'email.min' => 'Email chứa tối thiểu :min ký tự',
            'password.required' =>'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu chứa tối thiểu :min ký tự'
        ]);
        if(Auth::attempt([
            'email' =>$request->input('email'),
            'password' =>$request->input('password'),
            /* 'role' => 1 */ ])
        ){
            return redirect()->route('admin.welcome');
       
        }
        else {
            session()->flash('error', 'Email hoặc mật khẩu không chính xác');
           return redirect()->route('admin.auth.index');
        }
        
    }
    public function logout()
    {
        
        Auth::logout();

        return redirect()->route('admin.auth.index');
    }
   
    public function welcome()
    {
        return view('admin-views.welcome');
    }
    
}





