<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Weather;
use App\Site;
use App\Page;

class ApiSiteController extends Controller
{
    public function sidebar($site_id){
        $site= Site::find($site_id);
        return response()->json([ 'success' => $site->sidebar ]);
    }


    public function menu($site_id){
        $menu= Menu::where('site_id',$site_id)->select('id','name', 'type', 'link', 'parent_id')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($menu) ]);
    }

    public function page($site_id){
        $page= Page::where('site_id',$site_id)->select('id', 'title as name', 'type', 'parent_id', 'blank', 'link')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($page) ]);
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
