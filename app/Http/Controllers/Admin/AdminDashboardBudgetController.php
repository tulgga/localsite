<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dashboard_budget;

class AdminDashboardBudgetController extends Controller
{
    public function index()
    {
        $user=auth()->guard('admin-api')->user();

        extract(request()->only(['query', 'limit', 'page', 'orderBy', 'ascending', 'byColumn']));
        $result=Dashboard_budget::join('admin', 'admin.id', '=', 'dashboard_budgets.admin_id')
            ->select('dashboard_budgets.*', 'admin.user_name');

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
            $result = $result->orderBy('dashboard_budgets.id', 'desc');
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
                        $q->where('dashboard_budgets.'.$field,  "{$query}");
                    } else {
                        $q->where('dashboard_budgets.'.$field, 'LIKE', "%{$query}%");
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
                    $q->{$method}('dashboard_budgets.'.$field,  "{$query}");
                } else {
                    $q->{$method}('dashboard_budgets.'.$field, 'LIKE', "%{$query}%");
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
        $info = new Dashboard_budget();
        $info->b_type=$data['b_type'];
        $info->b_approved=$data['b_approved'];
        $info->b_done=$data['b_done'];
        $info->b_doing=$data['b_doing'];
        $info->b_do=$data['b_do'];
        $info->site_id=$data['site_id'];
        $info->admin_id=$data['admin_id'];
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
        $file=Dashboard_budget::find($id);
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

        $info =  Dashboard_budget::Find($id);
        $info->b_type=$data['b_type'];
        $info->b_approved=$data['b_approved'];
        $info->b_done=$data['b_done'];
        $info->b_doing=$data['b_doing'];
        $info->b_do=$data['b_do'];
        $info->site_id=$data['site_id'];
        $info->admin_id=$data['admin_id'];
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
        $zar=Dashboard_budget::find($id);
        $zar->delete();
    }
}
