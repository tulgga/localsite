<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Dashboard_police;
use Illuminate\Support\Facades\Auth;

class AdminDashboardPoliceController extends Controller
{
    public function index()
    {
        $user=auth()->guard('admin-api')->user();

        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Dashboard_police::join('admin', 'admin.id', '=', 'dashboard_polices.admin_id')
            ->select('dashboard_polices.*', 'admin.user_name');

        if($user->admin_type>0){
            $result=$result->where('admin_id', $user->id);
        }
        if (isset($query) && $query) {
            $result = $byColumn == 1 ?
                $this->filterByColumn($result, $query) :
                $this->filter($result, $query, ['title', 'content', 'price', 'cat_id', 'phone', 'email']);
        }

        if (isset($orderBy)) {
            $direction = $ascending == 1 ? 'ASC' : 'DESC';
            $result = $result->orderBy($orderBy, $direction);
        } else {
            $result = $result->orderBy('dashboard_polices.id', 'desc');
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
                    if($field=='site_id'){
                        $q->where('dashboard_polices.'.$field,  "{$query}");
                    } else {
                        $q->where('dashboard_polices.'.$field, 'LIKE', "%{$query}%");
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
                if($field=='site_id'){
                    $q->{$method}('dashboard_polices.'.$field,  "{$query}");
                } else {
                    $q->{$method}('dashboard_polices.'.$field, 'LIKE', "%{$query}%");
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
        $info = new Dashboard_police();
        $info->police_date=$data['police_date'];
        $info->crime_kill=$data['crime_kill'];
        $info->crime_theft=$data['crime_theft'];
        $info->crime_movement=$data['crime_movement'];
        $info->crime_other=$data['crime_other'];
        $info->ac_family=$data['ac_family'];
        $info->ac_healing=$data['ac_healing'];
        $info->ac_arrest=$data['ac_arrest'];
        $info->ac_fine=$data['ac_fine'];
        $info->ac_other=$data['ac_other'];
        $info->admin_id=$data['admin_id'];
        $info->site_id=$data['site_id'];
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
        $file=Dashboard_police::find($id);
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



        $info =  Dashboard_police::Find($id);
        $info->police_date=$data['police_date'];
        $info->crime_kill=$data['crime_kill'];
        $info->crime_theft=$data['crime_theft'];
        $info->crime_movement=$data['crime_movement'];
        $info->crime_other=$data['crime_other'];
        $info->ac_family=$data['ac_family'];
        $info->ac_healing=$data['ac_healing'];
        $info->ac_arrest=$data['ac_arrest'];
        $info->ac_fine=$data['ac_fine'];
        $info->ac_other=$data['ac_other'];
        $info->admin_id=$data['admin_id'];
        $info->site_id=$data['site_id'];
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
        $zar=Dashboard_police::find($id);
        $zar->delete();
    }
}
