<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Link_category;
use App\Link;

class AdminLinkCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1($site_id)
    {
        $results=Link_category::where('site_id', $site_id)->select('id', 'name', 'name as text', 'name as label')->orderBy('id', 'desc')->get();
        return response()->json([ 'success' => $results ]);
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
        $info = new Link_category();
        $info->name = $data['name'];
        $info->site_id = $data['site_id'];
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
        $info = Link_category::findOrFail($id);
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
        //file
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

        $info = Link_category::findOrFail($id);
        $info->name = $data['name'];
        $info->site_id = $data['site_id'];
        $info->save();

        return response()->json([
            'success' => $info,
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
        $link=Link::where('cat_id', $id)->count();

        if($link>0){
            return response()->json([ 'success' => 0, 'cnt'=>$link]);
        } else {
            Link_category::where('id', $id)->delete();
            return response()->json([ 'success' => 1 ]);
        }


    }
}
