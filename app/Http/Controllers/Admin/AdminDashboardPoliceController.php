<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Zar;
use App\Zar_category;

class AdminDashboardPoliceController extends Controller
{
    public function index()
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Zar::where('id', '!=', 0);

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['title', 'content', 'price', 'cat_id', 'phone', 'email']);
        }

        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $result = $result->orderBy($orderBy, $direction);
        } else {
            $result = $result->orderBy('id', 'desc');
        }

        $result = $result->paginate($limit);
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

        $img=Img::zar($request);

        $info = new Zar();
        $info->title=$data['title'];
        $info->content=$data['content'];
        $info->price=$data['price'];
        $info->phone=$data['phone'];
        $info->email=$data['email'];
        $info->cat_id=$data['cat_id'];
        $info->image=$img;
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
        $file=Zar::find($id);
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

        $img=Img::zar($request);

        $info =  Zar::Find($id);
        $info->title=$data['title'];
        $info->content=$data['content'];
        $info->price=$data['price'];
        $info->phone=$data['phone'];
        $info->email=$data['email'];
        $info->cat_id=$data['cat_id'];
        if(!is_null($img)){ $info->image=$img; }
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
        $zar=Zar::find($id);
        if(!is_null($zar->image)){
            Img::file_delete($zar->image);
            Img::file_delete(str_replace('zar/', 'zar/small/',$zar->image));

        }
        $zar->delete();
    }
}
