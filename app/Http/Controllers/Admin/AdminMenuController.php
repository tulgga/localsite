<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class AdminMenuController extends Controller
{
    public function index1($site_id)
    {
        $cats= Menu::where('site_id',$site_id)->select('menu.*', 'menu.name as label')->orderBy('order_num', 'asc')->get();
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

    public function save(Request $request, $site_id){
        $data = $request->get('data');
        $data = json_decode($data, true);
        Menu::where('site_id',$site_id)->delete();
        $this->extractTree($data, 0, $site_id);
    }

    public function extractTree($data, $parent_id=0, $site_id){
        foreach ($data as $i=>$d){
            $menu= new Menu();
            if($d['id']!=-1){  $menu->id=$d['id']; }
            $menu->name=$d['name'];
            $menu->site_id=$site_id;
            $menu->order_num=$i;
            $menu->parent_id=$parent_id;
            $menu->type=$d['type'];
            $menu->type_id=$d['type_id'];
            $menu->link=Menu::menuType($d['type'], $d['type_id'], $d['link']);
            $menu->blank=$d['blank'];
            $menu->save();
            if(array_key_exists('children', $d)){
                $this->extractTree($d['children'], $menu->id, $site_id);
            }
        }
    }
}
