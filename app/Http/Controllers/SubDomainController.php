<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubDomainController extends Controller
{

    public  function index($account){
        return $account.' tiimee';
    }
}
