<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use App\Volun_covered;
use App\Volun_rating;
use App\Volun_organization;
use App\Volun_user;

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
        $uid = "USR".rand(100000, 999999);
        $user = New Volun_user();
        $pass = md5($request->password);
        $user->Oid = $uid;
        $user->Password = md5($pass);
        $user->Email = $request->email;
        $user->CellPhone = $request->cellPhone;
        $user->save();
        $request->session()->flash('successMsg', 'Бүртгэл амжилттай хадгалагдлаа!');
        return redirect()->to('/register');
    }
    public function organizationRegister(Request $request){
        $uid = "ORG".rand(100000, 999999);
        $org = New Volun_organization();
        $pass = md5($request->password);
        $org->Oid = $uid;
        $org->Password = md5($pass);
        $org->Email = $request->email;
        $org->Phone = $request->cellPhone;
        $org->save();
        $request->session()->flash('successMsg', 'Бүртгэл амжилттай хадгалагдлаа!');
        return redirect()->to('/register');
    }
}
