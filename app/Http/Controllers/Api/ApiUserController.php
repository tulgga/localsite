<?php

namespace App\Http\Controllers\Api;

use Illuminate\Hashing\BcryptHasher;
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
            return response()->json(['success' => 0,'message' => 'Алдаатай json',]);
        }

        $validator = Validator::make($data, [
            'name' => 'required|string|unique:users',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|numeric',
            'birth_date' => 'required|date',
            'registration_no' => 'required|string|unique:users|size:10',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users|digits:8',
            'from' => 'required',
            'site_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0,'message' =>$validator->errors()->first()]);
        }

        $data['password'] = bcrypt($data['password']);
        $data['is_set_rd'] = 1;
        $data['status'] = 0;
        if($data['from']=='email'){
            $data['verify']=strval(rand(100000,999999));
            Mail::to($data['email'])->send(new SanalHuseltMail('Таны баталгаажуулах код: '.$data['verify'], 'Бүртгэл баталгаажуулах'));
        }

        if(!is_null($request->file('image'))){
            $data['profile_pic']=$request->file('image')->store('users');
        }

        $user = User::create($data);

        $user->save();

        $success['token'] = $user->createToken('MyApp')->accessToken;
        return response()->json(['success' => 1, 'message' => 'success', 'token' => $success['token']]);
    }



    public function verifyEmail(){
        $user = Auth::user();
        $user->verify=strval(rand(100000,999999));
        Mail::to($user->email)->send(new SanalHuseltMail('Таны баталгаажуулах код: '.$user->verify, 'Бүртгэл баталгаажуулах'));
        $user->save();
        return response()->json(['success' => 1, 'message' => 'success']);
    }



    public function verifyPhone(Request $request){
        $user = Auth::user();
        $user->status=1;
        $user->save();
        return $this->userInfo();
    }

    public function verify(Request $request){
        $user = Auth::user();
        if($request['verify']==$user->verify){
            $user->status=1;
            $user->verify=null;
            $user->save();
            return $this->userInfo();
        } else {
           return response()->json(['success' => 0, 'message' => 'Баталгаажуулах код буруу байна']);
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
            return response()->json(['success' => 0, 'message' => $request['name'].' нэвтрэх нэр, утасны дугаар, имэйл хаяг олдсонгүй']);
        }
        if($user->status>1 and $user->status<4){
            return response()->json(['success' => 0, 'message' => ' нэвтрэх нэр, утасны дугаар, имэйл хаяг олдсонгүй']);
        }
        $user->verify=strval(rand(100000,999999));
        $user->status = 4;
        Mail::to($user->email)->send(new SanalHuseltMail('Таны нууц үг сэргээх код: '.$user->verify, 'Нууц үг сэргээх'));
        $user->save();
        return response()->json(['success' => 1, 'message' => 'Таны нь нууц үг сэргээх код таны имэйл хаяглуу илгээлээ. та имэйл хаягаа шалгана уу']);
    }

    public function restorePassword(Request $request){

        $data = $request->post();
        $validator = Validator::make($data, [
            'verify' => 'required',
            'password' => 'required|string|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0,'message' =>$validator->errors()->first()]);
        }

        $user=User::where(['verify'=>$data['verify'], 'status'=>4])->first();
        if(!$user){  return response()->json(['success' => 0, 'message' => 'Нууц үг сэргээх код буруу байна.']);  }
        $user->status = 1;
        $user->verify = null;
        $user->password =  bcrypt($data['password']);
        $user->save();
        return response()->json(['success' => 1, 'message' => 'Нууц үг амжилттай солигдолоо']);
    }

    public function changeEmailRequest(Request $request){
        $user = Auth::user();


        $data['email']=$request['new_email'];

        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0,'message' =>$validator->errors()->first()]);
        }

        $user->new_email=$request['new_email'];
        $user->new_email_verify=strval(rand(100000,999999));
        Mail::to($user->new_email)->send(new SanalHuseltMail('Имэйл хаягаа солих код: '.$user->new_email_verify, 'Имэйл хаяг солих'));
        $user->save();
        return response()->json(['success' => 1, 'message' => 'Имэйл хаягаа солих кодыг таны шинэ мэйл хаяглуу илгээсэн байгаа']);
    }

    public function changeEmail(Request $request){
        $user = Auth::user();
        if($user->new_email_verify!=$request['new_email_verify']){
            return response()->json(['success' => 0, 'message' => 'Код буруу байна']);
        }
        $user->email=$user->new_email;
        $user->new_email=null;
        $user->new_email_verify=null;
        $user->save();
        return response()->json(['success' => 1, 'message' => 'Амжилттай']);
    }


    public function changePhoneRequest(Request $request){
        $user = Auth::user();


        $data['phone']=$request['new_phone'];

        $validator = Validator::make($data, [
            'phone' => 'required|numeric|unique:users|digits:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0,'message' =>$validator->errors()->first()]);
        }

        $user->new_phone=$request['new_phone'];
        $user->new_phone_verify=strval(rand(100000,999999));

        Mail::to($user->email)->send(new SanalHuseltMail('Утасны дугаараа солих код: '.$user->new_phone_verify, 'Утасны дугаараа солих'));
        $user->save();
        return response()->json(['success' => 1, 'message' => 'Утасны дугаараа солих кодыг таны  мэйл хаяглуу илгээсэн байгаа']);
    }

    public function changePhone(Request $request){
        $user = Auth::user();
        if($user->new_phone_verify!=$request['new_phone_verify']){
            return response()->json(['success' => 0, 'message' => 'Код буруу байна']);
        }
        $user->phone=$user->new_phone;
        $user->new_phone=null;
        $user->new_phone_verify=null;
        $user->save();
        return response()->json(['success' => 1, 'message' => 'Амжилттай']);
    }


    public function changePassword(Request $request){
        $user = Auth::user();
        if($request['newpassword']==$request['password']){
            return response()->json(
                [
                    'success' => 0,
                    'message' => 'Хуучин нууц үг шинэ нууц үг ижилхэн байна',
                ]
            );
        }

        $check=['name' => $user->name, 'password'=>$request['password']];
        if (Auth::guard('web')->attempt($check)) {
            $user->password = bcrypt($request['newpassword']);
            $user->save();
            return response()->json(
                [
                    'success' => 1,
                    'message' => 'Амжилттай',
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => 0,
                    'message' => 'Хуучин нууц үгээ буруу оруулсан байна',
                ]
            );
        }
    }


    public function FacebookLogin(Request $request){


        $user=User::where('email',$request['email'])->first();

        if ($user) {

            if($user->status==2 and $user->status==3){
                return response()->json(
                    [
                        'success' => 0,
                        'message' => 'Нэвтрэх боломжгүй',
                    ]
                );
            }
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(
                [
                    'success' => 1,
                    'message' => 'success',
                    'token' => $success['token'],
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => 1,
                    'message' => 'Шинэ бүртгэл үүсгэх',
                ]
            );
        }
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
//            if($user->status==0){
//                return response()->json(
//                    [
//                        'success' => 0,
//                        'message' => 'Та эрхээ баталгаажуулаагүй байна.',
//                    ]
//                );
//            }
            if($user->status==2 and $user->status==3){
                return response()->json(
                    [
                        'success' => 0,
                        'message' => 'Нэвтрэх боломжгүй',
                    ]
                );
            }
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(
                [
                    'success' => 1,
                    'message' => 'success',
                    'token' => $success['token'],
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => 0,
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
        return response()->json(['success' => 1, 'message' => 'success', 'data' => $user]);
    }

    public function notificationUpdate(Request $request)
    {
        $user = Auth::user();
        $data = $request->post();
        $user->is_notification=$data['is_notification'];
        $user->save();
        return response()->json(['success' => 1, 'message' => 'success']);
    }

    public function userInfoUpdate(Request $request)
    {
        $user = Auth::user();

        $data = $request->post();

        if($data == null){
            return response()->json(['success' => 0,'message' => 'Алдаатай json',]);
        }

        $validator = Validator::make($data, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|numeric',
            'birth_date' => 'required|date',
            'registration_no' => 'required|string|size:10',
            'site_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => 0,'message' =>$validator->errors()->first()]);
        }

        if(isset($data['password'])){
            $data['password']= bcrypt($data['password']);
        }

        if(isset($data['phone'])){unset($data['phone']);}
        if(isset($data['email'])){unset($data['email']);}
        $user->firstname=$data['firstname'];
        $user->lastname=$data['lastname'];
        $user->gender=$data['gender'];
        $user->birth_date=$data['birth_date'];
        $user->registration_no=$data['registration_no'];
        $user->site_id=$data['site_id'];
        $user->is_notification=$data['is_notification'];
        $user->is_notification_email=$data['is_notification_email'];

        if(!is_null($request->file('image'))){
            $user->profile_pic=$request->file('image')->store('users');
        }

        $user->save();
        return $this->userInfo();
    }

    public function logOut(){
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();
        }
        return response()->json(['success' => 1, 'message' => 'success']);
    }
}
