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

        if((int)$id>0){
            $id=(int)$id;
        }

        $d = Lavlagaa::where('parent_id', $id)->orderBy("order_num")->get();
        $arr=[];
        // undsen
        foreach ($d as $dat){
            $test_data= Lavlagaa::where('parent_id', $dat->id)->orderBy("order_num")->get();
            $arr2=[];
//
//            // sub
            foreach ($test_data as $s) {
                $s['sub2'] =Lavlagaa::where('parent_id', $s->id)->orderBy("order_num")->get();
                array_push($arr2,$s);
            }
//
            $dat['sub']=$arr2;

            array_push($arr,$dat);
        }
        $data['data']= $arr;
        $data['main']= Lavlagaa::where('parent_id', 0)->orderBy("order_num")->get();

        $data['now']= ($id != 0 && count(Lavlagaa::where('id', $id)->get())>0) ? Lavlagaa::find($id) : null;
        return view('service/index', $data);
    }
}
