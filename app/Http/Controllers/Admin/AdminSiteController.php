<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Site;

class AdminSiteController extends Controller
{
    public  function index(){
        $results=Site::orderBy('id', 'desc')->select('id','name','domain')->get();
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
