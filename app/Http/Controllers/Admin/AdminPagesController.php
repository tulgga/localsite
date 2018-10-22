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
    public function index($id)
    {
        $cats= Page::where('site_id',$id)->where('parent_id', 0)->orderBy('order_num', 'desc')->get();
        foreach ($cats as $c=>$cat){
            $cats[$c]['children']= Page::where('site_id',$id)->where('parent_id', $cat->id)->orderBy('order_num', 'desc')->get();
        }
        return response()->json([ 'success' => $cats ]);
    }

    public function single($id){
        $page= Page::find($id);
        return response()->json([ 'success' => $page ]);
    }

    public function indexMin($site_id, $id){
        $cats= Page::where('site_id',$site_id)->where('id','!=', $id)->where('parent_id', 0)->orderBy('order_num', 'desc')->select('id', 'title')->get();
        return response()->json([ 'success' => $cats ]);
    }

    public function update(Request $request, $id){

        $data = $request->get('data');
        $data = json_decode($data, true);

        $count= Page::where('parent_id',$id)->get()->count();

        if($count!=0 && $data['parent_id']!=0){
            return response()->json([ 'success' => 0 ]);
        }
        $image=Img::upload($request);

        if(!is_null($image)){
            $data['image'] = $image;
        }

        $Page=  Page::find($id);
        $Page->title=$data['title'];
        $Page->image=$data['image'];
        $Page->text=$data['text'];
        $Page->parent_id=$data['parent_id'];
        $Page->site_id=$data['site_id'];
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
        $Page->save();
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
