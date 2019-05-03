<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Menu;

class ApiPageController extends Controller
{

    public function single($site_id,$id){
        $page= Page::where('site_id', $site_id)->where('id',$id)->first();
        $page->shortContent=mb_substr(strip_tags($page->text), 0, 160);
        $page->menu=$this->getPageMainMenuID($page->id, $page->parent_id);
        return response()->json([ 'success' => $page ]);
    }

    public function getPageMainMenuID($id, $parent_id){
        if($parent_id==null){
            return $id;
        } else {
            $page=Page::find($parent_id);
            if($page){
                return   $this->getPageMainMenuID($page->id, $page->parent_id);
            }

        }
    }

    public function ildot()
    {
        $pages=Page::where('parent_id', 109)->orderBy('order_num', 'asc')->get();
        foreach ($pages as $c=>$page){
            $pages[$c]['children']= Page::where('parent_id', $page->id)->orderBy('order_num', 'asc')->get();
            foreach ($pages[$c]['children'] as $ci=>$cc){
                $pages[$c]['children'][$ci]['children']= Page::where('parent_id', $cc->id)->orderBy('order_num', 'asc')->get();
                foreach ($pages[$c]['children'][$ci]['children'] as $bi=>$bc){
                    $pages[$c]['children'][$ci]['children'][$bi]['children']= Page::where('parent_id', $bc->id)->orderBy('order_num', 'asc')->get();
                }
            }
        }
        return response()->json([ 'success' => $pages ]);
    }


}
