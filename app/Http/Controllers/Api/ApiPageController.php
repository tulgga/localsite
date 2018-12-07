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

        $menu=Menu::where('site_id', $site_id)->where('type',3)->where('type_id', $id)->first();
        if($menu){
            $page->menu=$this->getPageMainMenuID($menu->id, $menu->parent_id);
        } else {
            $page->menu=0;
        }

        return response()->json([ 'success' => $page ]);
    }

    public function getPageMainMenuID($id, $parent_id){
        if($parent_id==0){
            return $id;
        } else {
            $menu=Menu::find($parent_id);
            if($menu){
                return   $this->getPageMainMenuID($menu->id, $menu->parent_id);
            }

        }
    }
}
