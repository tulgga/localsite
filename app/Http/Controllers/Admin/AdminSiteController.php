<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Site;
use App\Settings;

class AdminSiteController extends Controller
{
    public  function index(){
        $results=Site::where('id','!=', 0)->orderBy('id', 'desc')->select('id','name','domain', 'name as label', 'name as text')->get();
        return response()->json([ 'success' => $results ]);
    }

    public function destroy($id)
    {
        $ban = Site::findOrFail($id);
        Site::where('id', $id)->delete();
    }

    public function show($id)
    {
        $info = Site::findOrFail($id);
        return response()->json([
            'success' => $info
        ]);
    }

    public function site_sidebar(Request $request, $id){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $info = Site::findOrFail($id);
        $info->sidebar = $data['sidebar'];
        $info->sidebar1 = $data['sidebar1'];
        $info->save();
    }

    public function site_config(Request $request, $id){
        $data = $request->get('data');
        $info = Site::findOrFail($id);
        if($request->hasFile('logo')){
            $info->logo =  $request->logo->store('logo');
        }
        if($request->hasFile('favicon')){
            $info->favicon =$request->favicon->store('favicon');
        }
        $info->config = $data;
        $info->save();

        if($id==0){
             $config = $request->get('config');
             $config = json_decode($config, true);
             $settings = Settings::findOrFail(1);
             $settings->google_api_key=$config['google_api_key'];
             $settings->google_analytics=$config['google_analytics'];
             $settings->service=$config['service'];
             $settings->save();
        }

    }

    public function get_config($id){
        $info = Site::findOrFail($id);

        $data['config']= json_decode($info->config, true);

        $data['logo']=null;
        if(!is_null($info->logo)){
            $data['logo']= url('/uploads/'.$info->logo);
        }

        $data['favicon']=null;
        if(!is_null($info->logo)){
            $data['favicon']= url('/uploads/'.$info->favicon);
        }


        $data['mainConfig']=null;
        if($id==0){
            $data['mainConfig']=Settings::where('id', 1)->select('google_api_key', 'google_analytics', 'service')->first();
        }

        return response()->json([
            'success' => $data,
        ]);
    }

    public function get_menu($id){
        $info = Site::findOrFail($id);
        return $info->menu;
    }

    public function site_menu(Request $request, $id){
        $info = Site::findOrFail($id);
        $info->menu =  $request->get('data');
        $info->save();
    }



    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'name' =>  ['required', Rule::unique('sites', 'name')->ignore($id)],
            'domain' => ['required', Rule::unique('sites', 'domain')->ignore($id)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $info = Site::findOrFail($id);
        $info->name = $data['name'];
        $info->domain = $data['domain'];
        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->get('data');

        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'name' => 'required|unique:sites',
            'domain' => 'required|unique:sites',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $info = new Site();
        $info->name = $data['name'];
        $info->domain = $data['domain'];
        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }
}
