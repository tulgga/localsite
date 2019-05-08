<?php

namespace App\Http\Controllers\Api;
use App\Dashboard_schedule;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
class ApiEventController extends Controller
{
    public function index($site_id=0)
    {
        $data=$this->MainData();
        $events = []; // event

        if($site_id > 0){
            $events = DB::select("select id, schedule_date as date,head_id as org_type, start_time as start, end_time as end, description,person_count, ifnull(cnt, 0) as person_going_count from dashboard_schedules 
                left join (
                    select dashboard_schedule_id, count(0) as cnt 
                    from  Dashboard_schedule_going 
                    where created_at >= '".$data['y']."'
                    group by dashboard_schedule_id 
                ) going
                
                on dashboard_schedules.id = going.dashboard_schedule_id
                
                where is_publish =1 and schedule_date >= '".$data['y']."'" );
        }

        return response()->json( $events);
    }


    public function MainData(){
        date_default_timezone_set('Asia/Ulaanbaatar');
        $data['y']=date('Y-m-d', strtotime( '-1 days' ) );
        return $data;
    }
}
