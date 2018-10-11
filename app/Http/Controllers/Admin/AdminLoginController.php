<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function guard()
    {
        return Auth::guard('admin');
    }

    public function login(Request $request)
    {
        $username = request('user_name');
        $password = request('password');

        $admin = Admin::where('user_name',$username)->first();

        if($admin && $admin->status == 1){
            if(Auth::guard('admin')->attempt(['user_name' => request('user_name'), 'password' => request('password')])){
                $user = Auth::guard('admin')->user();
                $success =  $user->createToken('admin')->accessToken;
                return response()->json(['success' => $success], 200);
            }
            else{
                return response()->json(['error'=>'Нууц үг буруу байна'], 200);
            }
        } else {
            return response()->json(['error'=>'Хэрэглэгчийн нэр байна'], 200);
        }
    }

    public function logout(Request $request)
    {
        $this->guard('admin')->logout();
        return response()->json(['success' => ''], 200);
    }
}
