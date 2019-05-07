<?php
namespace App\Http\Controllers;

use App\Model\Lavlagaa;
use App\Site;
class ServiceController extends Controller
{
    public function index($id=0){
        $data['site']= $site=Site::find(0);
        $data['subDomain'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
        $data['conf']= json_decode($site->config, true);
        $d = Lavlagaa::where('parent_id', 0)->orderBy("order_num")->get();
        $arr=[];
        foreach ($d as $dat){
            $dat['sub'] = Lavlagaa::where('parent_id', $dat->id)->orderBy("order_num")->get();
            array_push($arr,$dat);
        }
        $data['data']= $arr;
        $data['now_data']= [];
        $data['now']= null;
        if($id != 0 && count(Lavlagaa::where('id', $id)->get())>0){
            $data['now']= Lavlagaa::find($id);
            $data['now_data']= Lavlagaa::where('parent_id', (int)$id)->orderBy("order_num")->get();
        }
        return view('service/index', $data);
    }
}
