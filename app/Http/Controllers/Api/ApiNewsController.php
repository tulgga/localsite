<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class ApiNewsController extends Controller
{
    public function news(){
        $news=Post::orderBy('created_at', 'desc')->with('Category')->paginate(20);
        return response()->json(
            ['success'=>$news]
        );

    }
}
