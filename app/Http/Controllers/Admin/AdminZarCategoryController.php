<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zar_category;
class AdminZarCategoryController extends Controller
{

    public function index1($site_id)
    {
        $cats= Zar_category::where('site_id',$site_id)->select('zar_category.*', 'zar_category.name as label')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($cats) ]);
    }

    public function zar_category_select(){
        $data = $this->index1(0);
        return response()->json([ 'success' => $this->extractSelect($data->getData()->success) ]);
    }

    public function extractSelect($data, $depth=0, $return=[]){
        foreach ($data as $d){
            $return[]=['id'=>$d->id, 'text'=>str_repeat("-", $depth).$d->name];
            if(isset($d->children)){
                $return=$this->extractSelect($d->children,$depth+1, $return);
            }
        }
       return $return;
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
        Zar_category::where('site_id',$site_id)->delete();
        $this->extractTree($data, 0, $site_id);
    }


    public function extractTree($data, $parent_id=0, $site_id){
        foreach ($data as $i=>$d){
            $cat= new Zar_category();
            if($d['id']!=-1){  $cat->id=$d['id']; }
            $cat->name=$d['name'];
            $cat->site_id=$site_id;
            $cat->order_num=$i;
            $cat->parent_id=$parent_id;
            $cat->save();
            if(array_key_exists('children', $d)){
                 $this->extractTree($d['children'], $cat->id, $site_id);
            }
        }
    }


}
