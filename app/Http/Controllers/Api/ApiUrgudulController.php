<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Urgudul;
use App\Img;
use App\Heltes;

class ApiUrgudulController extends Controller
{
    //
    public function urgudul($site_id){
        $urgudul=Urgudul::where('site_id', $site_id)->orderBy('created_at', 'desc')->paginate(40);
        return response()->json(
            ['success'=>$urgudul]
        );
    }

    
    public function filterUrgudul(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        $urgudul=[];
        
        if($data['site_id']==0){
            $urgudul= Urgudul::where('site_id', 0);
        
            if($data['heltes_id']!=0){
                $urgudul=$urgudul->where('heltes_id', $data['heltes_id']);
            }
        }else{
            $urgudul=Urgudul::where('site_id', $data['site_id']);
             
        }
        
        
        if($data['user_id']!=-1){
            $urgudul=$urgudul->where('user_id', $data['user_id']);
        }
        if($data['type']!=-1){
            $urgudul=$urgudul->where('type', $data['type']);
        }
    
      

        if($data['status']!=-1){
            $urgudul=$urgudul->where('status', $data['status']);
        }

        if(!is_null($data['sdate'])){
            $urgudul=$urgudul->where('created_at','>=', $data['sdate'].' 00:00:00');
        }

        if(!is_null($data['fdate'])){
            $urgudul=$urgudul->where('created_at','<=', $data['fdate'].' 23:59:59');
        }
        

        $urgudul=$urgudul->orderBy('created_at', 'desc')->paginate(40);
        return response()->json(
            ['success'=>$urgudul]
        );
    }

    public function sendUrgudul(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        $urgudul = new Urgudul;
        $urgudul->image = Img::upload($request);
        $urgudul->type =$data['type'];
        $urgudul->name = $data['name'];
        $urgudul->phone = $data['phone'];
        $urgudul->email = $data['email'];
        if(isset($data['user_id'])){
            $urgudul->user_id = $data['user_id'];
        }
        if(isset($data['site_id'])){
            $urgudul->site_id = $data['site_id'];
        }
        $urgudul->heltes_id = $data['heltes_id'];
        $urgudul->content = $data['content'];
        $urgudul->ip = $_SERVER['REMOTE_ADDR'];
        $urgudul->user_agent=$_SERVER['HTTP_USER_AGENT'];
        $urgudul->save();

        return response()->json(['success'=>$urgudul]);
    }

    public function heltes()
    {
        $results=Heltes::orderBy('id', 'desc')->get();
        return response()->json([ 'success' => $results ]);
    }
}
