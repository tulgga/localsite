<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Img;
use App\Post;
use App\News_to_category;



class AdminNewsController extends Controller
{
    public function index($site_id)
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Post::with('Category')->where('site_id', $site_id);
        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['title', 'content', 'type', 'status', 'is_primary']);
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
                    if($field=='type' || $field=='status' || $field=='is_primary'){
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
                if($field=='type' || $field=='status' || $field=='is_primary'){
                    $q->{$method}($field,  "{$query}");
                } else {
                    $q->{$method}($field, 'LIKE', "%{$query}%");
                }
            }
        });
    }


    public function store(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);

        if($request->hasFile('image')){
            $data['image'] =Img::upload($request);
        }else{
            $data['image'] = null;
        }


        $post= new Post();
        $post->image=$data['image'];
        $post->site_id=$data['site_id'];
        $post->admin_id=$data['admin_id'];
        $post->title=$data['title'];
        $post->content=$data['content'];
        $post->short_content=$data['short_content'];
        $post->type=$data['type'];
        $post->status=$data['status'];
        $post->is_primary=$data['is_primary'];
        $post->save();

        $this->save_to_category($data['cat_id'],$post->id);

        return response()->json([ 'success' => 1 ]);
    }

    public function save_to_category($cats, $post_id){
        foreach ($cats as $cat){
            $toCat=new News_to_category();
            $toCat->post_id=$post_id;
            $toCat->cat_id=$cat;
            $toCat->save();
        }
    }


    public function change_primary(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $post = Post::find($data['id']);
        $post->is_primary=$data['flg'];
        $post->save();
    }

    public function change_status(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $post = Post::find($data['id']);
        $post->status=$data['flg'];
        $post->save();
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        if(!is_null($post->image)){
            Img::deleteImg($post->image);
        }
        $post->delete();
        News_to_category::where('post_id', $id)->delete();
    }

}
