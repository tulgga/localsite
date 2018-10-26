<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\File;
use Illuminate\Support\Facades\Redirect;
use App\Site;
use App\Settings;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $info = Site::findOrFail(0);
        $data['config']= json_decode($info->config, true);
        $data['logo']= url('/uploads/'.$info->logo);
        $data['favicon']= url('/uploads/'.$info->favicon);
        $data['mainConfig']=Settings::where('id', 1)->select('google_api_key', 'google_analytics')->first();
        return view('main', $data);
    }

    public function file_viewer(){

        if(isset($_GET['file'])){
            $data['file']=url('uploads/'.$_GET['file']);
            $type=File::fileType($_GET['file']);
            if($type=='none'){
                return 'энэ хүү файлын төрлийг үзэх боломжгүй';
            }
            if($type=='pdf' or $type=='image'){
                return Redirect::to($data['file']);
            }
            if($type=='office'){
                return Redirect::to('https://view.officeapps.live.com/op/view.aspx?src='.$data['file']);
            }

        } else {
            return 'файл олдсонгүй';
        }
    }
}
