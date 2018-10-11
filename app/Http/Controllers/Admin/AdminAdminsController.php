<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Admin;
use Hash;
class AdminAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Admin::select('*')->orderBy('id','desc')->get();
        return response()->json([
            'success' => $results,
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'f_name' => 'required',
            'user_name' => 'required|unique:admin',
            'email' => 'required|unique:admin',
            'admin_type' => 'required',
            'status' => 'required',
            'password' => 'min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        if($request->hasFile('image')){
            $path = $request->image->store('employees');
        }else{
            $path = '';
        }

        $info = new Admin();
        $info->l_name = $data['l_name'];
        $info->site_id = $data['site_id'];
        $info->f_name = $data['f_name'];
        $info->user_name = $data['user_name'];
        $info->email = $data['email'];
        $info->phone = $data['phone'];
        $info->admin_type = $data['admin_type'];
        $info->status = $data['status'];
        $info->password = Hash::make($data['password']);
        $info->profile_pic = $path;
        $info->save();

        return response()->json([
            'success' => $info,
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Admin::findOrFail($id);
        return response()->json([
            'success' => $info
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'f_name' => 'required',
            'user_name' => ['required', Rule::unique('admin', 'user_name')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('admin', 'email')->ignore($id)],
            'admin_type' => 'required',
            'status' => 'required',
            'password' => 'min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $info = Admin::findOrFail($id);
        $info->f_name = $data['f_name'];
        $info->l_name = $data['l_name'];
        $info->site_id = $data['site_id'];
        $info->user_name = $data['user_name'];
        $info->email = $data['email'];
        $info->phone = $data['phone'];
        $info->admin_type = $data['admin_type'];
        $info->status = $data['status'];
        if(isset($data['password']) && $data['password']){
            $info->password = Hash::make($data['password']);
        }

        if($request->hasFile('image')){
            // Storage::disk('local')->delete($info->profile_pic);
            $path = $request->image->store('employees');
            $info->profile_pic = $path;
        }

        $info->save();    

        return response()->json([
            'success' => $info,
        ]); 
    }

    public function change_status(Request $request)
    {
        
        $data = $request->get('data');
        $data = json_decode($data, true);
       
        
        $id = $data['id'];
        $addon = Admin::findOrFail($id);
        $addon->status = $data['flg'];
        $addon->save();
        return response()->json([
            'success' => $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
