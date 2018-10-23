<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zar;

class ApiZarController extends Controller
{
    //
    public function zar(){
        $zar = Zar::orderBy('created_at', 'desc')->with('Category')->paginate(20);
        return response()->json(
            ['success' => $zar]
        );
    }
}
