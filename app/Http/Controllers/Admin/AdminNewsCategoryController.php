<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Category;
use Illuminate\Support\Facades\DB;

class AdminNewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($site_id)
    {
        $cats= Category::where('site_id',$site_id)->select('category.*', 'category.name as label')->orderBy('order_num', 'asc')->get();
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
        Category::where('site_id',$site_id)->delete();
        $this->extractTree($data, 0, $site_id);
    }

    public function extractTree($data, $parent_id=0, $site_id){
        foreach ($data as $i=>$d){
            $cat= new Category();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



//    public function action(Request $request)
//    {
//        $data = $request->get('data');
//        $data = json_decode($data, true);
//
//        if($data['id']==0){
//            $cat= new Category();
//            $data['order_num']=Category::where('site_id', $data['site_id'])->where('parent_id', $data['parent_id'])->get()->count();
//        } else {
//            $count= Category::where('parent_id',$data['id'])->get()->count();
//            if($count!=0 && $data['parent_id']!=0){
//                return response()->json([ 'success' => 0 ]);
//            }
//
//            $cat= Category::find($data['id']);
//        }
//        $cat->name = $data['name'];
//        $cat->parent_id = $data['parent_id'];
//        $cat->order_num = $data['order_num'];
//        $cat->site_id = $data['site_id'];
//        $cat->save();
//        return response()->json([ 'success' => 1 ]);
//    }
//
//    public function change(Request $request){
//        $data = $request->get('data');
//        $data = json_decode($data, true);
//
//        $update= Category::find($data['id_1']);
//        $update->order_num=$data['id_1_num'];
//        $update->save();
//
//        $update= Category::find($data['id_2']);
//        $update->order_num=$data['id_2_num'];
//        $update->save();
//
//        return response()->json([ 'success' => 1 ]);
//    }
//
//    public function delete(Request $request)
//    {
//        $data = $request->get('data');
//        $data = json_decode($data, true);
//
//        Category::where('site_id', $data['site_id'])->where('parent_id', $data['id'])->delete();
//        Category::where('id', $data['id'])->delete();
//
//        $cats= Category::where('site_id',$data['site_id'])->where('parent_id', $data['parent_id'])->orderBy('order_num', 'asc')->get();
//        foreach ($cats as $i=>$cat){
//            $save=Category::find($cat->id);
//            $save->order_num=$i;
//            $save->save();
//        }
//
//        return response()->json([ 'success' => 1 ]);
//    }
}
