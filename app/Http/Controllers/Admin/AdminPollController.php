<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Poll_answer;
use App\Poll_result;
use App\Img;

class AdminPollController extends Controller
{
    public function index1($site_id)
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Poll::where('site_id', $site_id);

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['question', 'status','finish_date']);
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
                    if($field=='status'){
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
                if($field=='status'){
                    $q->{$method}($field,  "{$query}");
                } else {
                    $q->{$method}($field, 'LIKE', "%{$query}%");
                }
            }
        });
    }

    public function change_status(Request $request)
    {

        $data = $request->get('data');
        $data = json_decode($data, true);

        $id = $data['id'];
        $addon = Poll::findOrFail($id);
        $addon->status = $data['flg'];
        $addon->save();
        return response()->json([
            'success' => $id,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $poll = new Poll();
        if($data['finish_date']=='') { $data['finish_date']=null; }
        $poll->question=$data['question'];
        $poll->site_id=$data['site_id'];
        $poll->finish_date=$data['finish_date'];

        if($request->hasFile('image')){
            $poll->image=Img::upload($request);
        }
        $poll->save();

        foreach ( $data['answer'] as $answer){
            $poll_answer = new Poll_answer();
            $poll_answer->poll_id=$poll->id;
            $poll_answer->answer=$answer['answer'];
            $poll_answer->save();
        }

        return response()->json(['success' => $poll,]);
    }


    public function show($id)
    {
        $poll=Poll::with('Answer')->find($id);
        return response()->json([
            'success' => $poll,
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        if($data['finish_date']=='') { $data['finish_date']=null; }

        $poll =Poll::find($id);
        $poll->question=$data['question'];
        $poll->site_id=$data['site_id'];
        $poll->finish_date=$data['finish_date'];

        if($request->hasFile('image')){
            $poll->image=Img::upload($request);
        }

        $poll->save();

        Poll_answer::where('poll_id',$id)->delete();

        foreach ( $data['answer'] as $answer){
            $poll_answer = new Poll_answer();
            $poll_answer->poll_id=$poll->id;
            $poll_answer->id=$answer['id'];
            $poll_answer->answer=$answer['answer'];
            $poll_answer->save();
        }

        return response()->json([
            'success' => $poll,
        ]);
    }


    public function destroy($id)
    {
        $file=Poll::find($id);
        $file->delete();
        Poll_answer::where('poll_id', $id)->delete();
    }
}
