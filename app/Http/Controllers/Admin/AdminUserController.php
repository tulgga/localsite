<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Site;
use App\User;
use Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
class AdminUserController extends Controller
{
    public function AllUsers(){
        $result=User::orderBy('name', 'asc')->select('id', DB::raw("CONCAT(name, ' ', firstname,' ', lastname,' ', registration_no) AS label"))->get();
        return  response()->json(['success'=>$result]);
    }
    public function index()
    {
        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=User::where('id', '!=', 0);

        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['name', 'lastname',  'firstname', 'email', 'phone', 'gender', 'registration_no', 'status']);
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


    public function store(Request $request)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            'status' => 'required',
            'password' => 'min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        if($request->hasFile('image')){
            $path = $request->image->store('users');
        }else{
            $path = '';
        }

        $info = new User();
        $info->name = $data['name'];
        $info->lastname = $data['lastname'];
        $info->firstname = $data['firstname'];
        $info->email = $data['email'];
        $info->phone = $data['phone'];
        $info->gender = $data['gender'];
        $info->status = $data['status'];
        $info->birth_date = $data['birth_date'];
        $info->registration_no = $data['registration_no'];
        $info->password = bcrypt($data['password']);
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
        $info = User::findOrFail($id);
        return response()->json([
            'success' => $info
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'name' => ['required', Rule::unique('users', 'name')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'password' => 'min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $info = User::findOrFail($id);
        $info->name = $data['name'];
        $info->lastname = $data['lastname'];
        $info->firstname = $data['firstname'];
        $info->email = $data['email'];
        $info->phone = $data['phone'];
        $info->gender = $data['gender'];
        $info->status = $data['status'];
        $info->birth_date = $data['birth_date'];
        $info->registration_no = $data['registration_no'];

        if(isset($data['password']) && $data['password']){
            $info->password = bcrypt($data['password']);
        }

        if($request->hasFile('image')){
            Storage::delete($info->profile_pic);
            $path = $request->image->store('users');
            $info->profile_pic = $path;
        }

        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }

    public function destroy($id)
    {
        $admin=User::find($id);
        if($admin){
            Storage::delete($admin->profile_pic);
        }
        $admin->delete();
    }
}