<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Link;
use App\Link_category;
use App\Img;

class AdminLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1($site_id)
    {
        $results=Link::where('site_id', $site_id)->orderBy('id', 'desc')->get();
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
        $info = new Link();

        $info->name = $data['name'];
        $info->site_id = $data['site_id'];
        $info->cat_id = $data['cat_id'];
        $info->link = $data['link'];
        $image=Img::single($request, 'link');
        if(!is_null($image)){$info->image=$image; }
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
        $info = Link::findOrFail($id);
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
        $info = Link::findOrFail($id);
        $info->name = $data['name'];
        $info->site_id = $data['site_id'];
        $info->cat_id = $data['cat_id'];
        $info->link = $data['link'];
        $image=Img::single($request, 'link');
        if(!is_null($image)){$info->image=$image; }
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
        Link::where('id', $id)->delete();
    }
}
