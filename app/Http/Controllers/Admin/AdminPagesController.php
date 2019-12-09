<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Page;
use App\Img;
use Illuminate\Support\Facades\DB;

class AdminPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function page_select($site_id, $is_main=1){
        $pages= Page::where('is_main', $is_main)->where('site_id',$site_id)->select('pages.*', 'title as label')->orderBy('order_num', 'asc')->get();
        return response()->json([ 'success' => $this->buildTree($pages) ]);
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

    public function index1($id, $is_main=1)
    {
        $pages= Page::where('is_main', $is_main)->where('site_id',$id)->where('parent_id', null)->orderBy('order_num', 'asc')->get();
        foreach ($pages as $c=>$page){
            $pages[$c]['children']= Page::where('site_id',$id)->where('parent_id', $page->id)->orderBy('order_num', 'asc')->get();
            foreach ($pages[$c]['children'] as $ci=>$cc){
                $pages[$c]['children'][$ci]['children']= Page::where('parent_id', $cc->id)->orderBy('order_num', 'asc')->get();
                foreach ($pages[$c]['children'][$ci]['children'] as $bi=>$bc){
                    $pages[$c]['children'][$ci]['children'][$bi]['children']= Page::where('parent_id', $bc->id)->orderBy('order_num', 'asc')->get();
                }
            }
        }


        return response()->json([ 'success' => $pages ]);
    }




    public function single($id){
        $page= Page::find($id);
        return response()->json([ 'success' => $page ]);
    }

    public function indexMin($site_id, $id, $is_main=1){
        $return=[];
        $cats= Page::where('is_main', $is_main)->where('site_id',$site_id)->where('id','!=', $id)->where('parent_id', 0)->orderBy('order_num', 'asc')->select('id', 'title')->get();

        foreach ($cats as $i=>$cat){
            $return[$i]=$cat;
            $return[$i]['child']=Page::where('site_id',$site_id)->where('id','!=', $id)->where('parent_id', $cat->id)->orderBy('order_num', 'asc')->select('id', 'title')->get();
            foreach ($return[$i]['child'] as $a=>$child){
                $return[$i]['child'][$a]['child']=Page::where('site_id',$site_id)->where('id','!=', $id)->where('parent_id', $child->id)->orderBy('order_num', 'asc')->select('id', 'title')->get();
            }
        }
        return response()->json([ 'success' => $return ]);
    }

    public function update(Request $request, $id){

        $data = $request->get('data');
        $data = json_decode($data, true);

        $image=Img::upload($request);

        $Page=  Page::find($id);
        $Page->title=$data['title'];
        if(!is_null($image)) {
            $Page->image = $image;
        }
        $Page->text=$data['text'];
        $Page->is_main=$data['is_main'];
        if($data['parent_id']==0){ $data['parent_id']=null; }

        if($Page->parent_id!=$data['parent_id']){
            $Page->order_num=Page::where('parent_id', $data['parent_id'])->get()->count();
            $cats= Page::where('parent_id', $Page->parent_id)->orderBy('order_num', 'asc')->get();
            foreach ($cats as $i=>$cat){
                $save=Page::find($cat->id);
                $save->order_num=$i;
                $save->save();
            }
            $Page->parent_id=$data['parent_id'];
        }

        $Page->site_id=$data['site_id'];
        $Page->icon=$data['icon'];

        if(in_array($data['type'], [1,6])){
            $Page->link=$data['link'];
        } else {
            $Page->link='/p/'.$id;
        }
        $Page->list_type=$data['list_type'];
        $Page->type=$data['type'];
        $Page->type_id=$data['type_id'];
        $Page->blank=$data['blank'];

        $Page->save();

        return response()->json([ 'success' => $Page ]);
    }

    public function insert(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        if($request->hasFile('image')){
            $data['image'] =Img::upload($request);
        }else{
            $data['image'] = null;
        }
        if($data['parent_id']==0){ $data['parent_id']=null; }
        $data['order_num']=Page::where('site_id', $data['site_id'])->where('is_main', $data['is_main'])->where('parent_id', $data['parent_id'])->get()->count();

        $Page= new Page();
        $Page->title=$data['title'];
        $Page->image=$data['image'];
        $Page->text=$data['text'];
        $Page->site_id=$data['site_id'];
        $Page->parent_id=$data['parent_id'];
        $Page->order_num=$data['order_num'];
        $Page->is_main=$data['is_main'];
        $Page->type=$data['type'];
        $Page->type_id=$data['type_id'];
        $Page->list_type=$data['list_type'];
        $Page->blank=$data['blank'];
        $Page->icon=$data['icon'];
        $Page->save();

        if(in_array($data['type'], [1,6])){
            $Page->link=$data['link'];
        } else {
            $Page->link='/p/'.$Page->id;
        }
        $Page->save();
        return response()->json([ 'success' => $Page ]);
    }



    public function change(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        $update= Page::find($data['id_1']);
        $update->order_num=$data['id_1_num'];
        $update->save();

        $update= Page::find($data['id_2']);
        $update->order_num=$data['id_2_num'];
        $update->save();

        return response()->json([ 'success' => 1 ]);
    }

    public function delete(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        Page::where('site_id', $data['site_id'])->where('parent_id', $data['id'])->delete();
        Page::where('id', $data['id'])->delete();

        $cats= Page::where('site_id',$data['site_id'])->where('parent_id', $data['parent_id'])->orderBy('order_num', 'asc')->get();
        foreach ($cats as $i=>$cat){
            $save=Page::find($cat->id);
            $save->order_num=$i;
            $save->save();
        }

        return response()->json([ 'success' => 1 ]);
    }
}
