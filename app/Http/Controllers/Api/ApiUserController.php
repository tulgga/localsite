<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Mail\SanalHuseltMail;
use Illuminate\Support\Facades\Mail;
class ApiUserController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->post();

        if($data == null){
            return response()->json(['status' => 0,'message' => 'Алдаатай json',]);
        }

        $validator = Validator::make($data, [
            'name' => 'required|string|unique:users',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|numeric',
            'birth_date' => 'required|date',
            'registration_no' => 'required|string|unique:users|digits:10',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0,'message' =>$validator->errors()->first()]);
        }

        $data['password'] = bcrypt($data['password']);
        $data['verify']=strval(rand(100000,999999));
        $data['is_set_rd'] = 1;
        $data['status'] = 0;
        Mail::to($data['email'])->send(new SanalHuseltMail('Таны баталгаажуулах код: '.$data['verify'], 'Бүртгэл баталгаажуулах'));
        if(!is_null($request->file('image'))){
            $data['profile_pic']=$request->file('image')->store('users');
        }

        $user = User::create($data);


        $user->save();

        $success['token'] = $user->createToken('MyApp')->accessToken;
        return response()->json(['status' => 1, 'message' => 'success', 'token' => $success['token']]);
    }


    public function verify(Request $request){
        $user = Auth::user();
        if($request['verify']==$user->verify){
            $user->status=1;
            $user->verify=null;
            $user->save();
            return $this->userInfo();
        } else {
           return response()->json(['status' => 0, 'message' => 'Баталгаажуулах код буруу байна']);
        }
    }

    public function lostPassword(Request $request){
        if(is_numeric($request['name'])){
            $check=['phone'=>$request['name']];
        }
        elseif (filter_var($request['name'], FILTER_VALIDATE_EMAIL)) {
            $check= ['email' => $request['name']];
        } else {
            $check=['name' => $request['name']];
        }
        $user=User::where($check)->first();
        if(!$user){
            return response()->json(['status' => 0, 'message' => $request['name'].' нэвтрэх нэр, утасны дугаар, имэйл хаяг олдсонгүй']);
        }
        $user->verify=strval(rand(100000,999999));
        $user->status = 4;
        Mail::to($user->email)->send(new SanalHuseltMail('Таны нууц үг сэргээх код: '.$user->verify, 'Нууц үг сэргээх'));
        $user->save();
        return response()->json(['status' => 1, 'message' => 'Таны нь нууц үг сэргээх код таны имэйл хаяглуу илгээлээ. та имэйл хаягаа шалгана уу']);
    }

    public function restorePassword(Request $request){

        $data = $request->post();
        $validator = Validator::make($data, [
            'verify' => 'required',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0,'message' =>$validator->errors()->first()]);
        }

        $user=User::where(['verify'=>$data['verify'], 'status'=>4])->first();
        if(!$user){  return response()->json(['status' => 0, 'message' => 'Нууц үг сэргээх код буруу байна.']);  }
        $user->status = 1;
        $user->verify = null;
        $user->password =  bcrypt($data['password']);
        $user->save();
        return response()->json(['status' => 1, 'message' => 'Нууц үг амжилттай солигдолоо']);
    }

    public function login(Request $request)
    {


        if(is_numeric($request['name'])){
            $check=['phone'=>$request['name'], 'password'=>$request['password']];
        }
        elseif (filter_var($request['name'], FILTER_VALIDATE_EMAIL)) {
            $check= ['email' => $request['name'], 'password'=>$request['password']];
        } else {
            $check=['name' => $request['name'], 'password'=>$request['password']];
        }


        if (Auth::attempt($check)) {
            $user = Auth::user();
            if($user->status==0){
                return response()->json(
                    [
                        'status' => 0,
                        'message' => 'Та эрхээ баталгаажуулаагүй байна.',
                    ]
                );
            }
            if($user->status>1){
                return response()->json(
                    [
                        'status' => 0,
                        'message' => 'Нэвтрэх боломжгүй. Таны зээлийн эрх хаагдсан байна.',
                    ]
                );
            }
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(
                [
                    'status' => 1,
                    'message' => 'success',
                    'token' => $success['token'],
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => 0,
                    'message' => 'Хэрэглэгчийн нэр эсвэл нууц үг буруу байна',
                ]
            );
        }
    }

    public function userInfo()
    {
        $user = Auth::user();
        if(!is_null($user['profile_pic'])){
            $user['profile_pic']=url('/uploads/'.$user['profile_pic']);
        }
        return response()->json(['status' => 1, 'message' => 'success', 'data' => $user]);
    }

    public function logOut(){
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }
        return response()->json(['status' => 1, 'message' => 'success']);
    }
}
