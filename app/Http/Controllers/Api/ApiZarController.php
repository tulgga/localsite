<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zar;
use App\Zar_category;
use DB;
use App\Zar_image;
use App\Img;

class ApiZarController extends Controller
{
    //
    public function zar(){
        $zar=Zar::select("zar.*",
            DB::raw('CONCAT("'.env('APP_URL').'", "/uploads/", zar.image) AS image'),
            "zar_category.name as category")->join('zar_category', 'zar_category.id', '=', 'zar.cat_id')->orderBy('zar.is_pin', 'desc')->orderBy('zar.created_at', 'desc')->paginate(20);
        return response()->json(['success' => $zar]);
    }

    public function zarByCategoryId($id=0, $site_id=0){
        $childs=Zar_category::where('parent_id', $id)->get();
        $zar=Zar::select('zar.*', DB::raw('CONCAT("'.env('APP_URL').'", "/uploads/", zar.image) AS image'), 'zar_category.name as category')
            ->join('zar_category', 'zar_category.id', '=', 'zar.cat_id');
        
        if($site_id!=0){
            $zar=$zar->where('zar.site_id', $site_id);
        }

        if(count($childs)>0){
            foreach ($childs as $child): $ids[]=$child->id; endforeach;
            $zar=$zar->whereIn('zar.cat_id', $ids);
        } else {
            $zar=$zar->where('zar.cat_id', $id);
        }

        $zar=$zar->orderBy('zar.is_pin', 'desc')->orderBy('zar.created_at', 'desc')->paginate(20);
        return response()->json(['success' => $zar]);
    }

    public function zarSingle($id){
        $data['zar']=Zar::find($id);
        $data['zar']->image=url('uploads/'.$data['zar']->image);
        $data['selected_cat']=Zar_category::find($data['zar']->cat_id);
        $data['images']=Zar_image::where('zar_id', $id)->select('*', DB::raw('CONCAT("'.env('APP_URL').'", "/uploads/", image) AS image'))->get();
        return response()->json(['success' => $data]);
    }
    public function zarAdd(Request $request){
        $zar= new Zar();
        $zar->cat_id=strip_tags($request->cat_id);
        $zar->title=strip_tags($request->title);
        $zar->content=strip_tags($request->post('content'));
        $zar->price=strip_tags($request->price);
        $zar->phone=strip_tags($request->phone);
        $zar->email=strip_tags($request->email);
        
        if(isset($request->user_id)){
            $zar->user_id=strip_tags($request->user_id);
        }
        
        if(isset($request->site_id)){
            $zar->site_id=strip_tags($request->site_id);
        }
        
        $zar->save();

        if($request->file()){
            $i=1;
            foreach ($request->file() as $key=>$file){
                $img=Img::zar($request, $key);
                if($i==1){
                    $zar->image=$img;
                    $zar->save();
                }
                else {
                    $zar_image= new Zar_image();
                    $zar_image->zar_id=$zar->id;
                    $zar_image->image=$img;
                    $zar_image->save();
                }
                $i++;
            }
        }
        return $this->zarSingle($zar->id);
    }
}
