<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Site;

class AdminUserController extends Controller
{
    public function index(){
        $result['user'] = auth()->guard('admin-api')->user();
        if($result['user']->site_id!=0){
            $result['user']['site']=Site::find($result['user']->site_id)->select('id','name', 'domain')->first();
        } else {
            $result['user']['site']=['id'=>0, 'name'=>'Үндсэн сайт', 'domain'=>''];
        }

        return response()->json($result);
    }
}