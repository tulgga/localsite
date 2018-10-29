<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class ApiSiteController extends Controller
{
    public function menu($site_id){
        $cats= Menu::where('site_id',$site_id)->select('id','name', 'type', 'link', 'parent_id')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($cats) ]);
    }

    public function  buildTree($elements, $parentId = 0) {
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
