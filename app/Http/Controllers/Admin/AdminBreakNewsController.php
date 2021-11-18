<?php

namespace App\Http\Controllers\Admin;

use App\Prompt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBreakNewsController extends Controller
{
    public function index()
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Prompt::select('*');
            if (isset($query) && $query) {
                $result = $byColumn == 1 ?
                    $this->filterByColumn($result, $query) :
                    $this->filter($result, $query, ['content', 'public']);
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

    public function store(Request $request){
        $add = new Prompt();
        $add->content = $request->content;
        $add->public = $request->public;
        $add->save();
        return response()->json([ 'success' => 1 ]);
    }

    public function update(Request $request, $id)
    {
        $add = Prompt::find($id);
        $add->content = $request->content;
        $add->public = $request->public;
        $add->save();
        return response()->json([ 'success' => 1 ]);
    }
    public function change_status(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $post = Prompt::find($data['id']);
        $post->public=$data['flg'];
        $post->save();
    }

    public function destroy($id)
    {
        $post=Prompt::find($id);
        $post->delete();
    }

    protected function filterByColumn($data, $queries)
    {
        $queries = json_decode($queries);
        return $data->where(function ($q) use ($queries) {
            foreach ($queries as $field => $query) {
                if (is_string($query)) {
                    $in=['content', 'public'];
                    if(in_array($field, $in)){
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
                $in=['content', 'public'];
                if(in_array($field, $in)){
                    $q->{$method}($field,  "{$query}");
                } else {
                    $q->{$method}($field, 'LIKE', "%{$query}%");
                }
            }
        });
    }
}
