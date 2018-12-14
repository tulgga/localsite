<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\File;
use Illuminate\Support\Facades\Redirect;
use App\Site;
use App\Settings;
use App\Page;
use App\Post;
use App\News_to_site;
use phpDocumentor\Reflection\Location;

class SubController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($account){

      $data['info']=$this->getDomainInfo($account);
      $data['ontslokh']= Post::orderBy('created_at', 'desc')->where('site_id', $data['info']->id)->where('is_primary', 1)->where('status',1)->with('Category')->select('title', 'id', 'image', 'type','short_content','created_at')
          ->limit(5)->get();
      $data['latest_news']= Post::orderBy('created_at', 'desc')->where('site_id', $data['info']->id)->where('is_primary', 0)->where('status',1)->with('Category')->select('title', 'id', 'image', 'type','short_content','created_at')
            ->limit(6)->get();
      $data['province_news'] = Post::orderBy('posts.created_at', 'desc')->
      where('posts.site_id', 0)->
      where('posts.status',1)->with('Category')->
      select('posts.title', 'posts.id', 'posts.image', 'posts.type','posts.created_at')->
          Join('news_to_sites', 'news_to_sites.post_id', '=', 'posts.id')
          ->whereIn('news_to_sites.site_id', [$data['info']->id,0])
          ->limit(6)->get();
      $data['other_menu'] = Page::where('site_id',$data['info']->id)->where('is_main',0)->select('id', 'title as name', 'link', 'icon')->orderBy('order_num', 'asc')->get();
      return view('sub.home', $data);
    }



    public function page($account, $id){
        $data['info']=$this->getDomainInfo($account);
        return view('sub.page', $data);
    }

    public function news($account, $id){
        $data['info']=$this->getDomainInfo($account);
        $data['news']= Post::where('id', $id)->
        where('status',1)->with('Category')->
        select('id', 'title', 'image', 'type','content','created_at')->get();
        return view('sub.news', $data);
    }

    public function category($account, $id){
        $data['info']=$this->getDomainInfo($account);
        return view('sub.category', $data);
    }

    public function files($account, $id){
        $data['info']=$this->getDomainInfo($account);
        return view('sub.file', $data);
    }


    public function getDomainInfo($account){
        $site=Site::where('domain',$account)->first();
        if(is_null($site)){
            header('Location:'.env('APP_URL'));
            die();
        }
        $site->config = json_decode($site->config, true);
        $site->menu=$this->getMenu($site->id);
        return $site;
    }


    public function getMenu($site_id){
        $page= Page::where('site_id',$site_id)->where('is_main',1)->select('id', 'title as name', 'type', 'parent_id', 'blank', 'link')->orderBy('order_num', 'asc')->get();
        return  $this->buildTree($page);
    }

    public function  buildTree($elements, $parentId = null) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->buildTree($elements, $element->id);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}
