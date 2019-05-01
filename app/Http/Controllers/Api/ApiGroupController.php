<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiGroupController extends Controller
{
    public function group(){

        $query="
            select groups.*,   IFNULL(joined_cnt, 0) as joined_cnt
            from groups
            LEFT JOIN (
                select group_id,  COUNT(0) as joined_cnt
                from group_users 
                where status=0
                GROUP by group_id
            ) joined
            on joined.group_id=groups.id
            where groups.status=1
            order by groups.id DESC
        ";
        $results=\DB::select($query);
        return response()->json([ 'success' => $results ]);
    }
}
