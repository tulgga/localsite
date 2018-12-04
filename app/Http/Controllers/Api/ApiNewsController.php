<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class ApiNewsController extends Controller
{

    public function site_news($site_id, $limit=20){
        $news=Post::where('site_id',$site_id)->where('status', 1)
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary', 'view_count', 'created_at')
            ->with('Category')->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(
            ['success'=>$news]
        );
    }

    public function oronnutag($limit=20){
        $news=Post::where('site_id','!=',0)->where('main_site_publish', 2)->where('status', 1)
            ->select('posts.id', 'posts.title', 'posts.short_content', 'posts.image', 'posts.type', 'posts.is_primary', 'posts.view_count', 'posts.created_at', 'sites.name as site')
            ->Join('sites', 'sites.id', '=', 'posts.site_id')
            ->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(
            ['success'=>$news]
        );
    }

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
