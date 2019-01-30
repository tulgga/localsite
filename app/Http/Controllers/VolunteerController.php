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
}
