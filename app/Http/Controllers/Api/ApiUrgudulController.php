<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Urgudul;
use App\Img;

class ApiUrgudulController extends Controller
{
    //
    public function urgudul($site_id){
        $urgudul=Urgudul::where('site_id', $site_id)->orderBy('created_at', 'desc')->paginate(40);
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
        $urgudul->content = $data['content'];
        $urgudul->ip = $_SERVER['REMOTE_ADDR'];
        $urgudul->save();

        return response()->json(['success'=>$urgudul]);
    }
}
