<?php

namespace App\Http\Controllers\Admin;

use App\Mail\SanalHuseltMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Urgudul;
use App\Img;


class AdminUrgudulController extends Controller
{
    public function index1($site_id)
    {
        $user = auth()->guard('admin-api')->user();



        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Urgudul::where('id', '!=', 0)->where('site_id', $site_id);


        if($user->admin_type==1 && $user->heltes_id!=0){
            $result=$result->where('heltes_id', $user->heltes_id);
        }

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['name', 'type', 'email', 'phone', 'content']);
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

    public function webNotification($site_id, $heltes_id){
        $result=Urgudul::where('status', 0);
        if($site_id!=0){
            $result=$result->where('site_id', $site_id);
        } else {
            $result=$result->where('site_id', 0);
            if($heltes_id!=0){
                $result=$result->where('heltes_id', $heltes_id);
            }
        }
        $result=$result->get();
        return response()->json(
            ['success'=>$result->count()]
        );
    }

    public function index()
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Urgudul::where('id', '!=', 0);

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['name', 'type', 'email', 'phone', 'content']);
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
                    if($field=='type'){
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
                if($field=='type'){
                    $q->{$method}($field,  "{$query}");
                } else {
                    $q->{$method}($field, 'LIKE', "%{$query}%");
                }
            }
        });
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $info =Urgudul::find($id);
        $info->reply=$data['reply'];
        if($request->hasFile('image')){
            $info->reply_image =Img::upload($request);
        }
        $info->status=1;
        $info->save();

//        Mail::to($info->email)->send(new SanalHuseltMail($info->reply, 'Санал хүсэлтийн хариу'));

        return response()->json([
            'success' => $info,
        ]);
    }

    public function destroy($id)
    {
        $Urgudul=Urgudul::find($id);
        if(!is_null($Urgudul->image)){
            Img::file_delete($Urgudul->image);
        }
        $Urgudul->delete();
    }
}
