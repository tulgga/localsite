<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admin;
use Illuminate\Http\Request;
use App\Site;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            if(Auth::guard('admin')->attempt(['user_name' => $username, 'password' => $password])){
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

    public function index(){
        $result['user'] = auth()->guard('admin-api')->user();
        if($result['user']->site_id!=0){
            $result['user']['site']=Site::where('id',$result['user']->site_id)->select('id','name', 'domain')->first();
        } else {
            $result['user']['site']=['id'=>0, 'name'=>'Үндсэн сайт', 'domain'=>''];
        }

        return response()->json($result);
    }


}
