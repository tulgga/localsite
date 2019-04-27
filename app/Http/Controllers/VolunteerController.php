<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use App\Volunteers_cover;
use App\Volunteers_like;
use App\Volunteers_rating;
use App\User;
use App\Site;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    public function index(){
        $data['volunteers'] = Volunteer::select('*')->where('status', 1)->orderBy('created_at', 'desc')->limit(8)->get();
        return view('volunteer.home', $data);
    }
    public function login(){
        return view('volunteer.login');
    }
    public function register(){
        $data['site'] = Site::select('id','name')->orderBy('name','ASC')->get();
        return view('volunteer.register',$data);
    }
    public function userRegister(Request $request){
        if($request->password == $request->verify_password){

            $register = $request->registration_no;
            $year = $register[4].$register[5];
            $month = $register[6].$register[7];
            $day = $register[8].$register[9];
            $gender = $register[10]%2;
            if($month > 12){
                $year = 2000+$year;
                $month -= 20;
            }else{
                $year = 1900+$year;
            }

            $user = New User();
            $pass = bcrypt($request->verify_password);
            $user->name = $request->username;
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->registration_no = $request->registration_no;
            $user->site_id = $request->site_id;
            $user->password = $pass;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $gender;
            $user->birth_date = $year."-".$month."-".$day;
            $user->save();
            $request->session()->flash('successMsg', 'Бүртгэл амжилттай хадгалагдлаа!');
            return redirect()->to('/register');
        }else{
            $request->session()->flash('username',$request->username);
            $request->session()->flash('lastname',$request->lastname);
            $request->session()->flash('firstname',$request->firstname);
            $request->session()->flash('site_id',$request->site_id);
            $request->session()->flash('email',$request->email);
            $request->session()->flash('phone',$request->phone);
            $request->session()->flash('registration_no',$request->registration_no);
            $request->session()->flash('passwordMatchMsg', 'Нууц уг таарахгүй байна!');
            return redirect()->to('/register');
        }

    }
    public function loginUser(Request $request){

        if(is_numeric($request['username'])){

            $check=['phone'=>$request['username'], 'password'=>$request['password']];

        } elseif (filter_var($request['username'], FILTER_VALIDATE_EMAIL)) {

            $check= ['email' => $request['username'], 'password'=>$request['password']];

        } else {

            $check=['name' => $request['username'], 'password'=>$request['password']];

        }

        if (Auth::attempt($check)) {
            $user = Auth::user();
            if($user->status == 0){
                $request->session()->flash('loginMsg', 'Та эрхээ баталгаажуулаагүй байна.');
                return redirect()->to('/login');
            }elseif($user->status == 1){
                $request->session()->get('user_id', $user->id);
                $request->session()->get('logged_id', true);
                return redirect()->to('/');
            }

        } else {
            $request->session()->flash('loginMsg', 'Хэрэглэгчийн нэр эсвэл нууц үг буруу байна!');
            return redirect()->to('/login');
        }
    }
}
