<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class ApiNewsController extends Controller
{
    public function news($site_id,$id){
        $news=Post::where('site_id',$site_id)->where('id', $id)->where('status', 1)->with('Category')->first();
        return response()->json(
            ['success'=>$news]
        );
    }

    public function news_ontslokh($id){
        $news=Post::orderBy('created_at', 'desc')->where('site_id', $id)->where('is_primary', 1)->where('status',1)->with('Category')
            ->select('title', 'id', 'image', 'created_at')
            ->limit(3)->get();
        return response()->json(
            ['success'=>$news]
        );
    }
}
