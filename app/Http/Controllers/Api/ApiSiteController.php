<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Weather;
use App\Site;
use App\Page;
use App\Settings;
use App\Worker;

class ApiSiteController extends Controller
{
    public function sidebar($site_id){
        $site= Site::find($site_id);
        return response()->json([ 'success' => $site->sidebar ]);
    }
    public function sidebar1($site_id){
        $site= Site::find($site_id);
        return response()->json([ 'success' => $site->sidebar1 ]);
    }

    public function workers(){
        $worker=Worker::where('name', 'not like', '%сум%')->get();
        foreach ($worker as $i=>$v){
            $worker[$i]->json_data=json_decode($v->json_data);
        }
        return response()->json([ 'success' => $worker ]);
    }

    public function sites(){
        $sites=Site::where('id', '!=', 0)->orderBy('name', 'asc')->select('favicon', 'name', 'domain', 'id')->get();
        return response()->json([ 'success' => $sites ]);
    }

    public function service(){
        $data=Settings::where('id', 1)->select('service')->first();
        return  $data->service ;
    }

    public function page($site_id, $is_main=1){
        $page= Page::where('site_id',$site_id)->where('is_main',$is_main)->select('id', 'title as name', 'type', 'parent_id', 'blank', 'link')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($page) ]);
    }

    public function submenu($site_id){
        $page= Page::where('site_id',$site_id)->where('is_main',0)->select('id', 'title', 'type', 'link',  'icon')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $page ]);
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

    public function weather(){
        return Weather::get_content();
    }
}
