<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use App\Volunteers_cover;
use App\Volunteers_like;
use App\Volunteers_rating;
use App\User;

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
        return view('volunteer.register');
    }
    public function userRegister(Request $request){
        if($request->password == $request->verify_password){
            $user = New User();
            $pass = bcrypt($request->verify_password);
            $user->name = $request->username;
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->registration_no = $request->registration_no;
            $user->password = $pass;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            $request->session()->flash('successMsg', 'Бүртгэл амжилттай хадгалагдлаа!');
            return redirect()->to('/register');
        }else{
            $request->session()->flash('username',$request->username);
            $request->session()->flash('lastname',$request->lastname);
            $request->session()->flash('firstname',$request->firstname);
            $request->session()->flash('email',$request->email);
            $request->session()->flash('phone',$request->phone);
            $request->session()->flash('registration_no',$request->registration_no);
            $request->session()->flash('passwordMatchMsg', 'Нууц уг таарахгүй байна!');
            return redirect()->to('/register');
        }

    }
}
