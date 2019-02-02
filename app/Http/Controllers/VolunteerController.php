<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Volunteer;
use App\Volun_covered;
use App\Volun_evalution;
use App\Volun_organization;
use App\Volun_user;

class VolunteerController extends Controller
{
    public function index(){
        return view('volunteer.home');
    }
    public function login(){
        return view('volunteer.login');
    }
    public function register(){
        return view('volunteer.register');
    }
    public function userResiter(Request $request){
        $user = New Volun_user();
        $pass = md5($request->password);
        $user->Password = md5($pass);
        $user->Email = $request->email;
        $user->CellPhone = $request->cellPhone;
        $user->save();
        $request->session()->flash('successMsg', 'Бүртгэл амжилттай хадгалагдлаа!');
        return redirect()->to('/register');
    }
}
