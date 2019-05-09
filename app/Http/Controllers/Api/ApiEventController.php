<?php

namespace App\Http\Controllers\Api;
use App\Dashboard_schedule;
use App\Dashboard_schedule_going;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\DB;
class ApiEventController extends Controller
{
    public function index($site_id=0)
    {
        $data=$this->MainData();
        $events = []; // event

        if($site_id > 0 ){
            $events = DB::select("select id, schedule_date as date,head_id as org_type, start_time as start, 
            end_time as end, description,person_count, ifnull(cnt, 0) as person_going_count 
            
            from dashboard_schedules 
                left join (
                    select dashboard_schedule_id, count(0) as cnt 
                    from  dashboard_schedule_goings 
                    where created_at >= '".$data['y']."'
                    group by dashboard_schedule_id 
                ) going on dashboard_schedules.id = going.dashboard_schedule_id
                
            where is_publish =1 and schedule_date >= '".$data['y']."'" );
        }

        return response()->json( ['success'=>$events]);
    }

    public function going($id, $user_id=0, $ip='', $device="")
    {
        if(count(Dashboard_schedule_going::where('dashboard_schedule_id',$id)->where('user_id',$user_id)->get())==0 ){
            $go = new Dashboard_schedule_going();
            $go->dashboard_schedule_id = $id;
            $go->user_id = $user_id;
            $go->ip = $ip;
            $go->device = $device;
            $go->save();
            return response()->json(["success"=> 1]);
        }
        return response()->json(["success"=> 0]);
    }


    public function MainData(){
        date_default_timezone_set('Asia/Ulaanbaatar');
        $data['y']=date('Y-m-d', strtotime( '-1 days' ) );
        return $data;
    }
}