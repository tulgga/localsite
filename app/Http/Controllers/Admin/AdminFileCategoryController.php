<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\File_category;
use Illuminate\Support\Facades\DB;

class AdminFileCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cats= File_category::where('site_id',$id)->where('parent_id', 0)->orderBy('order_num', 'desc')->get();

        foreach ($cats as $c=>$cat){
            $cats[$c]['children']= File_category::where('site_id',$id)->where('parent_id', $cat->id)->orderBy('order_num', 'desc')->get();
        }
        return response()->json([ 'success' => $cats ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        if($data['id']==0){
            $cat= new File_category();
            $data['order_num']=File_category::where('site_id', $data['site_id'])->where('parent_id', $data['parent_id'])->get()->count();
        } else {
            $count= File_category::where('parent_id',$data['id'])->get()->count();
            if($count!=0 && $data['parent_id']!=0){
                return response()->json([ 'success' => 0 ]);
            }

            $cat= File_category::find($data['id']);
        }
        $cat->name = $data['name'];
        $cat->parent_id = $data['parent_id'];
        $cat->order_num = $data['order_num'];
        $cat->site_id = $data['site_id'];
        $cat->save();
        return response()->json([ 'success' => 1 ]);
    }

    public function change(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        $update= File_category::find($data['id_1']);
        $update->order_num=$data['id_1_num'];
        $update->save();

        $update= File_category::find($data['id_2']);
        $update->order_num=$data['id_2_num'];
        $update->save();

        return response()->json([ 'success' => 1 ]);
    }

    public function delete(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        File_category::where('site_id', $data['site_id'])->where('parent_id', $data['id'])->delete();
        File_category::where('id', $data['id'])->delete();

        $cats= File_category::where('site_id',$data['site_id'])->where('parent_id', $data['parent_id'])->orderBy('order_num', 'asc')->get();
        foreach ($cats as $i=>$cat){
            $save=File_category::find($cat->id);
            $save->order_num=$i;
            $save->save();
        }

        return response()->json([ 'success' => 1 ]);
    }
}
