<?php

namespace App\Http\Controllers\Api;

use App\Rate;
use App\Rate_item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Input;


class ApiNewsController extends Controller
{

    public function site_news($site_id, $limit=20){
        $news=Post::where('site_id',$site_id)->where('status', 1)
            ->select('posts.id', 'posts.title', 'posts.short_content', 'posts.image', 'posts.type', 'posts.is_primary', 'posts.view_count', 'posts.created_at')
            ->Join('news_to_category', 'news_to_category.post_id', '=', 'posts.id')
            ->where('news_to_category.cat_id', 164)
            ->groupBy('posts.id')
            ->with('Category', 'Site')->orderBy('posts.created_at', 'desc')
            ->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function VideoList($site_id, $limit=12){
        $news=Post::where('site_id',$site_id)->where('status', 1)->where('type', 2)
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary', 'view_count', 'created_at')
            ->with('Category')->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function oronnutag($limit=20){
        $news=Post::where('site_id','!=',0)->where('main_site_publish', 2)->where('status', 1)
            ->select('posts.id', 'posts.title', 'posts.short_content', 'posts.image', 'posts.type', 'posts.is_primary', 'posts.view_count', 'posts.created_at', 'posts.site_id', 'sites.name as site', 'sites.domain')
            ->Join('sites', 'sites.id', '=', 'posts.site_id')
            ->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function newsListPrimary($limit=10){
        $news=Post::where('site_id',0)->where('status', 1)->where('is_primary', 1)
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary',  'created_at')->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function newsListPhoto($limit=10){
        $news=Post::where('site_id',0)->where('status', 1)->where('type', 1)
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary',  'created_at')->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function newsListVideo($limit=10){
        $news=Post::where('site_id',0)->where('status', 1)->where('type', 2)
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary',  'created_at')->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function newsListRecent($limit=10){
        $news=Post::where('site_id',0)->where('status', 1)
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary',  'created_at')->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function searchNews(){
        $news=Post::where('site_id',0)->where('status', 1) ->where(function ($query) {

            $query->where('title', 'like', '%'.Input::get('s').'%')
                ->orWhere('content', 'like', '%'.Input::get('s').'%');
        })
            ->select('id', 'title', 'short_content', 'image', 'type', 'is_primary', 'view_count', 'created_at')->with('Category')->orderBy('created_at', 'desc')->paginate(50);
        return response()->json(['success'=>$news]);
    }

    public function newsListOronnutag($limit=10){
        $news=Post::where('site_id','!=',0)->where('main_site_publish', 2)->where('status', 1)
            ->select('posts.id', 'posts.title', 'posts.short_content', 'posts.image', 'posts.type', 'posts.is_primary', 'posts.view_count',  'posts.created_at', 'sites.name as site', 'sites.domain')
            ->Join('sites', 'sites.id', '=', 'posts.site_id')
            ->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }


    public function newsListByCategoryBox($site_id, $limit, $catID){
        $news=Post::where('posts.site_id',$site_id)->where('posts.status', 1)->where('news_to_category.cat_id', $catID)
            ->select('posts.id', 'posts.title', 'posts.short_content', 'posts.view_count',  'posts.type', 'posts.image', 'posts.created_at')
            ->Join('news_to_category', 'news_to_category.post_id', '=', 'posts.id')
            ->groupBy('posts.id')
            ->orderBy('created_at', 'desc')->paginate($limit);
        return response()->json(['success'=>$news]);
    }

    public function CatTimeLine($catID){
        $news=Post::where('posts.site_id',0)->where('posts.status', 1)->where('news_to_category.cat_id', $catID)
            ->select('posts.id', 'posts.title', 'posts.short_content', 'posts.content', 'posts.type', 'posts.image')
            ->Join('news_to_category', 'news_to_category.post_id', '=', 'posts.id')
            ->groupBy('posts.id')
            ->orderBy('posts.created_at', 'desc')->limit(50)->get();
        return response()->json(['success'=>$news]);
    }

    public function newsListByCategory($site_id, $catID){
        $news=Post::where('posts.site_id',$site_id)->where('posts.status', 1)->where('news_to_category.cat_id', $catID)
            ->select('posts.id', 'posts.title',    'posts.created_at')
            ->Join('news_to_category', 'news_to_category.post_id', '=', 'posts.id')
            ->groupBy('posts.id')
            ->orderBy('created_at', 'desc')->limit(30)->get();
        return response()->json(['success'=>$news]);
    }

    public function news($site_id,$id){
        if($site_id>0){
            $news=Post::where('posts.site_id',$site_id)->where('posts.id', $id)->where('posts.status', 1)
            ->select('posts.*', 'sites.name as site', 'sites.domain')
            ->Join('sites', 'sites.id', '=', 'posts.site_id')
            ->with('Category')->first();

            $news->view_count +=1;
            $news->save();
            return response()->json(['success'=>$news]);
        }else{
            $news=Post::where('site_id',$site_id)
            ->where('id', $id)
            ->where('status', 1)
            ->with('Category')->first();

            $news->view_count +=1;
            $news->save();
            return response()->json(['success'=>$news]);
        }
    }
    public function news_rates($id){
        $items = Rate_item::orderBy('id','asc')->get();
        foreach($items as $key => $item){
            $count = Rate::where('post_id',$id)->where('item_id',$item->id)->count();
            $items[$key]['count'] = $count;
        }
        return response()->json(['success'=>$items]);
    }
    public function set_news_rate(Request $req, $id){

        if(isset($req->item_id)){
            $check = Rate::where('post_id',$id)->where('ip',$_SERVER['REMOTE_ADDR'])->where('updated_at','>',date('Y-m-d H:i:s'))->orderBy('created_at','desc')->first();
            if(is_null($check)){
                $rate = new Rate();
                $rate->item_id = $req->item_id;
                $rate->post_id = $id;
                $rate->ip = $_SERVER['REMOTE_ADDR'];
                $rate->updated_at = date('Y-m-d H:i:s', strtotime('+1 hours'));
                $rate->save();
                return response()->json(['success'=>0, 'msg'=>'Баярлалаа. ']);
            }else {
                return response()->json(['success'=>1, 'msg'=>'Та үнэлгээ өгсөн байна']);
            }

        }else{
            return response()->json(['success'=>1, 'msg'=>'Талбар дутуу']);
        }

    }
    public function news_ontslokh($id){
        $news=Post::orderBy('created_at', 'desc')->where('site_id', $id)->where('is_primary', 1)->where('status',1)->with('Category')
            ->select('title', 'id', 'image', 'type','created_at')
            ->limit(5)->get();
        return response()->json(['success'=>$news]);
    }


    public function categoryInfo($id){
        $cat=Category::find($id);
        return response()->json(
            ['success'=>$cat]
        );
    }

    public function news_category($site_id)
    {
        $cats= Category::where('site_id',$site_id)->select('category.*', 'category.name as label')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($cats) ]);
    }

    public function  buildTree($elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildTree($elements, $element->id);
                if ($children) { $element['children'] = $children; }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}
