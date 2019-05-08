<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Model\Lavlagaa;

class ApiPageController extends Controller
{
    public function selected_menus($id){
        $m0= Page::find($id);
        if(is_null($m0->parent_id)) {
            $array= [$m0->id, 0, 0 ,0, 0];
            return response()->json([ 'success' => $array ]);
        }
        $m1= Page::find($m0->parent_id);
        if(is_null($m1->parent_id)) {
            $array= [$m1->id, $m0->id, 0 ,0, 0];
            return response()->json([ 'success' => $array ]);
        }
        $m2= Page::find($m1->parent_id);
        if(is_null($m2->parent_id)) {
            $array= [$m2->id, $m1->id, $m0->id ,0, 0];
            return response()->json([ 'success' => $array ]);
        }
        $m3= Page::find($m2->parent_id);
        if(is_null($m3->parent_id)) {
            $array= [$m3->id, $m2->id, $m1->id ,$m0->id, 0];
            return response()->json([ 'success' => $array ]);
        }
        $m4= Page::find($m3->parent_id);
        if(is_null($m4->parent_id)) {
            $array= [$m4->id, $m3->id, $m2->id ,$m1->id, $m0->id];
            return response()->json([ 'success' => $array ]);
        }
    }
    public function single($site_id,$id){
        $page= Page::where('site_id', $site_id)->where('id',$id)->first();
        $page->shortContent=mb_substr(strip_tags($page->text), 0, 160);
        $page->menu=$this->getPageMainMenuID($page->id, $page->parent_id);
        return response()->json([ 'success' => $page ]);
    }

    public function Lavlagaa(){
        $pages=Lavlagaa::where('parent_id', 0)->orderBy('order_num', 'asc')->get();
        foreach ($pages as $c=>$page){
            $pages[$c]['children']= Lavlagaa::where('parent_id', $page->id)->orderBy('order_num', 'asc')->get();
            foreach ($pages[$c]['children'] as $ci=>$cc){
                $pages[$c]['children'][$ci]['children']= Lavlagaa::where('parent_id', $cc->id)->orderBy('order_num', 'asc')->get();
                foreach ($pages[$c]['children'][$ci]['children'] as $bi=>$bc){
                    $pages[$c]['children'][$ci]['children'][$bi]['children']= Lavlagaa::where('parent_id', $bc->id)->orderBy('order_num', 'asc')->get();
                }
            }
        }
        return response()->json([ 'success' => $pages ]);
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
