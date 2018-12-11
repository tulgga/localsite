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

    public function page_select_old($site_id){
        $pages= Page::where('site_id',$site_id)->where('parent_id', 0)->select('id', 'title as label')->orderBy('order_num', 'asc')->get();
        foreach ($pages as $c=>$page){
            $pages[$c]['children']= Page::where('site_id',$site_id)->where('parent_id', $page->id)->select('id', 'title as label')->orderBy('order_num', 'asc')->get();
            foreach ($pages[$c]['children']  as $ci=>$cc){
                $pages[$c]['children'][$ci]['children']= Page::where('site_id',$site_id)->where('parent_id', $cc->id)->select('id', 'title as label')->orderBy('order_num', 'asc')->get();
                foreach ($pages[$c]['children'][$ci]['children'] as $bi=>$bc){
                    $pages[$c]['children'][$ci]['children'][$bi]['children']= Page::where('site_id',$site_id)->where('parent_id', $bc->id)->select('id', 'title as label')->orderBy('order_num', 'asc')->get();
                }

            }
        }
        return response()->json([ 'success' => $pages ]);
    }

    public function page_select($site_id){
        $pages= Page::where('site_id',$site_id)->select('pages.*', 'title as label')->orderBy('order_num', 'asc')->get();
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

    public function index1($id)
    {
        $pages= Page::where('site_id',$id)->where('parent_id', null)->orderBy('order_num', 'asc')->get();
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

    public function indexMin($site_id, $id){
        $return=[];
        $cats= Page::where('site_id',$site_id)->where('id','!=', $id)->where('parent_id', 0)->orderBy('order_num', 'asc')->select('id', 'title')->get();

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

        $count= Page::where('parent_id',$id)->get()->count();

//        if($count!=0 && $data['parent_id']!=0){
//            return response()->json([ 'success' => 0 ]);
//        }
        $image=Img::upload($request);

        $Page=  Page::find($id);
        $Page->title=$data['title'];
        if(!is_null($image)) {
            $Page->image = $image;
        }
        $Page->text=$data['text'];
        $Page->parent_id=$data['parent_id'];
        $Page->site_id=$data['site_id'];

        if($data['type']==1){
            $Page->link=$data['link'];
        } else {
            $Page->link='/p/'.$id;
        }

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
        $data['order_num']=Page::where('site_id', $data['site_id'])->where('parent_id', $data['parent_id'])->get()->count();

        $Page= new Page();
        $Page->title=$data['title'];
        $Page->image=$data['image'];
        $Page->text=$data['text'];
        $Page->site_id=$data['site_id'];
        $Page->parent_id=$data['parent_id'];
        $Page->order_num=$data['order_num'];
        $Page->type=$data['type'];
        $Page->type_id=$data['type_id'];
        $Page->blank=$data['blank'];
        $Page->save();

        if($data['type']==1){
            $Page->link=$data['link'];
        } else {
            $Page->link='/p/'.$Page->id;
        }

        return response()->json([ 'success' => $Page ]);
    }

    public function action(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        if($data['id']==0){
            $cat= new Page();
            $data['order_num']=Page::where('site_id', $data['site_id'])->where('parent_id', $data['parent_id'])->get()->count();
        } else {
            if($data['id'])
            $cat= Page::find($data['id']);
        }
        $cat->title = $data['title'];
        $cat->parent_id = $data['parent_id'];
        $cat->order_num = $data['order_num'];
        $cat->site_id = $data['site_id'];
        $cat->save();
        return response()->json([ 'success' => 1 ]);
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
