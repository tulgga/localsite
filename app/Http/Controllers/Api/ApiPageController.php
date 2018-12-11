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
}
