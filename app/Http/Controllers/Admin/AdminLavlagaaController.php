<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Img;
use App\Model\Lavlagaa;
use Illuminate\Support\Facades\DB;

class AdminLavlagaaController extends Controller
{
    public function index()
    {
        $pages= Lavlagaa::where('parent_id', 0)->orderBy('order_num', 'asc')->get();
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

    public function single($id){
        $page= Lavlagaa::find($id);
        return response()->json([ 'success' => $page ]);
    }

    public function update(Request $request, $id){

        $data = $request->get('data');
        $data = json_decode($data, true);
        $image=Img::upload($request);
        $Page=  Lavlagaa::find($id);
        $Page->title=$data['title'];
        $Page->is_org=$data['is_org'];
        if(!is_null($image)) { $Page->image = $image; }
        $Page->text=$data['text'];
        if($Page->parent_id!=$data['parent_id']){
            $Page->order_num=Lavlagaa::where('parent_id', $data['parent_id'])->get()->count();
            $cats= Lavlagaa::where('parent_id', $Page->parent_id)->orderBy('order_num', 'asc')->get();
            foreach ($cats as $i=>$cat){
                $save=Lavlagaa::find($cat->id);
                $save->order_num=$i;
                $save->save();
            }
            $Page->parent_id=$data['parent_id'];
        }

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

        $data['order_num']=Lavlagaa::where('parent_id', $data['parent_id'])->get()->count();
        $Page= new Lavlagaa();
        $Page->title=$data['title'];
        $Page->image=$data['image'];
        $Page->text=$data['text'];
        $Page->parent_id=$data['parent_id'];
        $Page->order_num=$data['order_num'];
        $Page->is_org=$data['is_org'];
        $Page->save();
        return response()->json([ 'success' => $Page ]);
    }



    public function change(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        $update= Lavlagaa::find($data['id_1']);
        $update->order_num=$data['id_1_num'];
        $update->save();

        $update= Lavlagaa::find($data['id_2']);
        $update->order_num=$data['id_2_num'];
        $update->save();

        return response()->json([ 'success' => 1 ]);
    }

    public function delete(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);
        Lavlagaa::where('id', $data['id'])->delete();

        $cats= Lavlagaa::where('parent_id', $data['parent_id'])->orderBy('order_num', 'asc')->get();
        foreach ($cats as $i=>$cat){
            $save=Lavlagaa::find($cat->id);
            $save->order_num=$i;
            $save->save();
        }

        return response()->json([ 'success' => 1 ]);
    }
}
