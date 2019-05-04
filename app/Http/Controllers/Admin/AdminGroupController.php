<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Group;
use App\User;
use App\Model\Group_user;
class AdminGroupController extends Controller
{
    public function index()
    {
        $query="
            select groups.*,  IFNULL(request_cnt, 0) as request_cnt, IFNULL(joined_cnt, 0) as joined_cnt, users.name as username
            from groups
            LEFT JOIN (
                select group_id,  COUNT(0) as request_cnt
                from group_users 
                where status=0
                GROUP by group_id
            ) request
            on request.group_id=groups.id
            LEFT JOIN (
                select group_id,  COUNT(0) as joined_cnt
                from group_users 
                where status=1
                GROUP by group_id
            ) joined
             on joined.group_id=groups.id
            join users 
            on users.id=groups.admin_user_id
           
            order by groups.id DESC
        ";
        $results=\DB::select($query);
        return response()->json([ 'success' => $results ]);
    }

    public function users($id){

        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));

        $result=  Group_user::join('users', 'users.id', '=','group_users.user_id')
            ->select('group_users.id','users.firstname', 'users.lastname', 'users.name', 'users.profile_pic', 'group_users.status', 'group_users.created_at');

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['firstname', 'lastname', 'name', 'status']);
        }

        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $result = $result->orderBy($orderBy, $direction);
        } else {
            $result = $result->orderBy('group_users.created_at', 'DESC');
        }

        $result = $result->paginate($limit);

        return response()->json([
            'success' => $result,
        ]);

    }

    protected function filterByColumn($data, $queries)
    {
        $queries = json_decode($queries);
        return $data->where(function ($q) use ($queries) {
            foreach ($queries as $field => $query) {
                if (is_string($query)) {
                    $q->where($field, 'LIKE', "%{$query}%");
                }
            }
        });
    }


    protected function filter($data, $query, $fields)
    {
        return $data->where(function ($q) use ($query, $fields) {
            foreach ($fields as $index => $field) {
                $method = $index > 0 ? 'orWhere' : 'where';
                $q->{$method}($field, 'like', "%{$query}%");
            }
        });
    }


    public function destroy($id)
    {
//        Group::findOrFail($id);
        Group::where('id', $id)->delete();
    }

    public function show($id)
    {
        $info = Group::findOrFail($id);
        return response()->json(['success' => $info]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $info = Group::findOrFail($id);
        $info->name = $data['name'];
        $info->admin_user_id = $data['admin_user_id'];
        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->get('data');

        $data = json_decode($data, true);

        $info = new Group();
        $info->name = $data['name'];
        $info->admin_user_id = $data['admin_user_id'];
        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }

    public function user_change_yes($id){
        $group = Group_user::findOrFail($id);
        $group->status = 1;
        $group->save();
        return response()->json(['success' => $id,]);
    }

    public function user_change_no($id){
        $group = Group_user::findOrFail($id);
        $group->delete();
        return response()->json(['success' => $id,]);
    }

    public function change_status(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);
        $group = Group::findOrFail($data['id']);
        $group->status = $data['flg'];
        $group->save();
        return response()->json(['success' => $data['id']]);
    }
}
