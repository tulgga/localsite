<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\File_to_category;
use App\File_category;
use App\Img;

class AdminFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function file_select($site_id){
        $result=File::where('site_id', $site_id)->orderBy('id','desc')->select('id', 'name as label')->get();
        return response()->json(['success'=>$result]);
    }

    public function index($site_id)
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=File::where('site_id', $site_id);

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['name', 'content', 'cat_id']);
        }

        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $result = $result->orderBy($orderBy, $direction);
        } else {
            $result = $result->orderBy('id', 'desc');
        }

        $result = $result->with('Category')->paginate($limit);
        return response()->json(
            ['success'=>$result]
        );
    }


    protected function filterByColumn($data, $queries)
    {
        $queries = json_decode($queries);
        return $data->where(function ($q) use ($queries) {
            foreach ($queries as $field => $query) {
                if (is_string($query)) {
                    if($field=='cat_id'){
                        $q->where($field,  "{$query}");
                    } else {
                        $q->where($field, 'LIKE', "%{$query}%");
                    }
                }
            }
        });
    }


    protected function filter($data, $query, $fields)
    {
        return $data->where(function ($q) use ($query, $fields) {
            foreach ($fields as $index => $field) {
                $method = $index > 0 ? 'orWhere' : 'where';
                if($field=='cat_id'){
                    $q->{$method}($field,  "{$query}");
                } else {
                    $q->{$method}($field, 'LIKE', "%{$query}%");
                }
            }
        });
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

        $file=Img::file($request, 'file');

        $info = new File();
        $info->name=$data['name'];
        $info->status=$data['status'];
        $info->cart_number=$data['cart_number'];
        $info->publish_date=$data['publish_date'];
        $info->active_date=$data['active_date'];
        $info->content=$data['content'];
        $info->site_id=$data['site_id'];
        $info->file=$file;
        $info->save();

        $this->save_to_category($data['cat_id'],$info->id);

        return response()->json([
            'success' => $info,
        ]);
    }

    public function save_to_category($cats, $file_id){
        foreach ($cats as $cat){
            $toCat=new File_to_category();
            $toCat->file_id=$file_id;
            $toCat->cat_id=$cat;
            $toCat->save();

//            $file_cats=File_category::where('parent_id', $cat)->get();
//            if(count($file_cats)!=0){
//                $send=[];
//                foreach ($file_cats as $file_cat){
//                    $send[]=$file_cat['id'];
//                }
//                $this->save_to_category($send, $file_id);
//            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file=File::with('Category')->find($id);

        $ids=[];
        foreach ($file->category as $c){$ids[]=$c->cat_id;}
        $file->cat_id=$ids;

        return response()->json([
            'success' => $file,
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

        $file=Img::file($request, 'file');

        $info =File::find($id);
        $info->name=$data['name'];
        $info->status=$data['status'];
        $info->cart_number=$data['cart_number'];
        $info->publish_date=$data['publish_date'];
        $info->active_date=$data['active_date'];
        $info->content=$data['content'];
        $info->site_id=$data['site_id'];
        if(!is_null($file)){ $info->file=$file; }
        $info->save();

        File_to_category::where('file_id', $id)->delete();

        $this->save_to_category($data['cat_id'],$id);

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
        $file=File::find($id);
        if(!is_null($file->file)){
            Img::file_delete($file->file);
        }
        $file->delete();
        File_to_category::where('file_id', $id)->delete();
    }
}
