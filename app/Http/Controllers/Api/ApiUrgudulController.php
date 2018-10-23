<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Urgudul;

class ApiUrgudulController extends Controller
{
    //
    public function urgudul(){
        $urgudul=Urgudul::orderBy('created_at', 'desc')->paginate(20);
        return response()->json(
            ['success'=>$urgudul]
        );
    }
}
