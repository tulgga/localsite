<?php
namespace App\Http\Controllers;

use App\Dashboard_news;
use App\Dashboard_budget;
use App\Dashboard_schedule;
use App\Site;
class Dashboard extends Controller
{
  public function index($site_id=0, $user_role=0)
  {
      $data=$this->MainData();
      $data['t']=[]; // event
      $hospital_data = null; // hospital
      $nema_data = null; // hospital
      $police_data = null; // hospital
      $data['news'] = [];
      $dates =[];
      $date = $data['today'];
      while (strtotime($date) <= strtotime($data['date14'])) {
          $obj['date'] = $date;
          $obj['data'] = Dashboard_schedule::where('head_id', $user_role)->where('site_id',$site_id)->where('schedule_date',$date)->orderBy('start_time', 'DESC')->get();
          $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
          array_push($dates, $obj);
      }
      $data['owner_schedule']= $dates; // даргийн цагийн хуваарь

      if($site_id==0){ // аймаг
          if(Dashboard_news::where('created_at','>=', $data['y'])->first()) {
              $data['news']= Dashboard_news::where('created_at', '>=', $data['y'])->get();
          }

          if(Dashboard_schedule::whereNotIn('head_id', [1,2,3])->where('schedule_date','>=', $data['y'])->first()) {
              $data['t']= Dashboard_schedule::whereNotIn('head_id', [1,2,3])->where('schedule_date','>=', $data['y'])->orderBy('id', 'DESC')->get();
          }


          $hospital_data =
              \DB::select('SELECT sum(die) as die,
                sum(birth) as birth,
                 sum(call_remote)  as call_remote,
                 sum(call_near)  as call_near,
                 sum(inspection)  as inspection,
                 sum(inpatient)  as inpatient,
                 sum(ytt)  as ytt,
                 sum(inspection) as  inspection,
                 SUM(die + birth + call_remote+ call_near+ inspection+ inpatient+ ytt+ inspection) as total
                 FROM dashboard_hospitals WHERE site_id > 0 AND hospical_date = ?', [$data['y']]);

          $police_data = \DB::select('SELECT sum(crime_kill) as crime_kill,
             sum(crime_theft)  as crime_theft,
             sum(crime_movement)  as crime_movement,
             sum(crime_other)  as crime_other,
             sum(ac_family)  as ac_family,
             sum(ac_healing)  as ac_healing,
             sum(ac_arrest) as  ac_arrest,
             sum(ac_fine) as ac_fine,
             sum(ac_other) as ac_other,
             SUM(crime_kill + crime_theft+ crime_movement + crime_other+ ac_family+ ac_healing+ ac_arrest+ac_fine+ac_other) as total
             FROM dashboard_polices WHERE site_id > 0 AND police_date = ?', [$data['y']]);

          $nema_data = \DB::select('SELECT sum(fo)  as fo,
             sum(ff)  as ff,
             sum(sos)  as sos,
             SUM(fo + ff+ sos) as total,
             sos_description 
             FROM dashboard_nemas WHERE site_id > 0 AND nema_date = ?', [$data['y']]);
          $nema_data = $nema_data!=null && count($nema_data)>0 ? $nema_data[0] : null;

          if($nema_data!=null){
              $nema_data->sos_description  ="-";
          }
          $data['n'] =$nema_data;

          $chart_data=[];
          $interval_date = $data['y_8'];
          while (strtotime($interval_date) <= strtotime($data['y'])) {
              $obj['date'] = $interval_date;
              $police_count = \DB::select('SELECT SUM(crime_kill + crime_theft+ crime_movement + crime_other+ ac_family+ ac_healing+ ac_arrest+ac_fine+ac_other) as total FROM dashboard_polices WHERE site_id > 0 AND police_date = ?', [$interval_date]);
              $police_count = $police_count!=null && count($police_count)>0 ? $police_count[0] : null;

              if($police_count != null){
                  $police_count =$police_count->total;
              }
              $obj['police_count'] =(int) $police_count;


              $hospital_count = \DB::select('SELECT SUM(die + birth + call_remote+ call_near+ inspection+ inpatient+ ytt+ inspection) as total FROM dashboard_hospitals WHERE site_id > 0 AND hospical_date = ?', [$interval_date]);
              $hospital_count = $hospital_count!=null && count($hospital_count)>0 ? $hospital_count[0] : null;

              if($hospital_count != null){
                  $hospital_count =$hospital_count->total;
              }
              $obj['hospital_count'] =(int) $hospital_count;

              $nema_count = \DB::select('SELECT  SUM(fo + ff+ sos) as total FROM dashboard_nemas WHERE site_id > 0 AND nema_date = ?', [$interval_date]);
              $nema_count = $nema_count!=null && count($nema_count)>0 ? $nema_count[0] : null;

              if($nema_count != null){
                  $nema_count =$nema_count->total;
              }
              $obj['nema_count'] =(int) $nema_count;

              $interval_date = date ("Y-m-d", strtotime("+1 day", strtotime($interval_date)));
              array_push($chart_data, $obj);
          }
          $data['chart_data'] =$chart_data;

      }else{ // sum
          if(Dashboard_news::where('created_at','>=', $data['y'])->where('site_id', $site_id)->first()) {
              $data['news']= Dashboard_news::where('created_at', '>=', $data['y'])->where('site_id', $site_id)->get();
          }
          if(Dashboard_schedule::whereNotIn('head_id', [1,2,3])->where('schedule_date','>=', $data['y'])->where('site_id', $site_id)->get()) {
              $data['t']= Dashboard_schedule::whereNotIn('head_id', [1,2,3])->where('schedule_date','>=', $data['y'])->where('site_id', $site_id)->orderBy('id', 'DESC')->get();
          }
          $hospital_data =\DB::select('SELECT die, birth, call_remote,call_near, inspection, inpatient, ytt, inspection, SUM(die + birth + call_remote+ call_near+ inspection+ inpatient+ ytt+ inspection) as total FROM dashboard_hospitals WHERE site_id = ? AND hospical_date = ?', [(int)$site_id,$data['y']]);

          $police_data = \DB::select('SELECT crime_kill,crime_theft, crime_movement,crime_other,ac_family,ac_healing,ac_arrest,ac_fine,ac_other, SUM(crime_kill + crime_theft+ crime_movement + crime_other+ ac_family+ ac_healing+ ac_arrest+ac_fine+ac_other) as total FROM dashboard_polices WHERE site_id = ? AND police_date = ?', [(int)$site_id,$data['y']]);

          $nema_data= \DB::select('SELECT fo,ff, sos,sos_description,SUM(fo + ff+ sos) as total FROM dashboard_nemas WHERE site_id = ? AND nema_date = ?', [(int)$site_id,$data['y']]);
          $data['n'] = $nema_data!=null && count($nema_data)>0 ? $nema_data[0] : null;



          $chart_data=[];
          $interval_date = $data['y_8'];
          while (strtotime($interval_date) <= strtotime($data['y'])) {
              $obj['date'] = $interval_date;
              $police_count = \DB::select('SELECT SUM(crime_kill + crime_theft+ crime_movement + crime_other+ ac_family+ ac_healing+ ac_arrest+ac_fine+ac_other) as total FROM dashboard_polices WHERE site_id =? AND police_date = ?', [$site_id,$interval_date]);
              $police_count = $police_count!=null && count($police_count)>0 ? $police_count[0] : null;

              if($police_count != null){
                  $police_count =$police_count->total;
              }
              $obj['police_count'] =(int) $police_count;


              $hospital_count = \DB::select('SELECT SUM(die + birth + call_remote+ call_near+ inspection+ inpatient+ ytt+ inspection) as total FROM dashboard_hospitals WHERE site_id =? AND hospical_date = ?', [$site_id,$interval_date]);
              $hospital_count = $hospital_count!=null && count($hospital_count)>0 ? $hospital_count[0] : null;

              if($hospital_count != null){
                  $hospital_count =$hospital_count->total;
              }
              $obj['hospital_count'] =(int) $hospital_count;

              $nema_count = \DB::select('SELECT  SUM(fo + ff+ sos) as total FROM dashboard_nemas WHERE site_id=? AND nema_date = ?', [$site_id,$interval_date]);
              $nema_count = $nema_count!=null && count($nema_count)>0 ? $nema_count[0] : null;

              if($nema_count != null){
                  $nema_count =$nema_count->total;
              }
              $obj['nema_count'] =(int) $nema_count;

              $interval_date = date ("Y-m-d", strtotime("+1 day", strtotime($interval_date)));
              array_push($chart_data, $obj);
          }
          $data['chart_data'] =$chart_data;
      }

      $data['h'] = $hospital_data!=null && count($hospital_data)>0 ? $hospital_data[0] : null;
      $data['p'] = $police_data!=null && count($police_data)>0 ? $police_data[0] : null;
      $data['budgets'] = [];
      $col = ($site_id == 0) ? collect([1, 2, 3, 4]) : collect([1, 2, 4]);
      foreach ($col as $i) {
          if (Dashboard_budget::where('b_type', $i)->get()) {
              array_push($data['budgets'], Dashboard_budget::where('b_type', $i)->orderBy('id', 'DESC')->first());
          }
      }







      return view('dashboard/index', $data);
  }

  public function login(){
      return view('dashboard/login');
  }

  public function police()
  {
    $data=$this->MainData();
    return view('dashboard/add_police', $data);
  }

  public function hospital()
  {
    $data=$this->MainData();
    return view('dashboard/add_hospital', $data);
  }

  public function nema(){
    $data=$this->MainData();
    return view('dashboard/add_nema', $data);
  }

  public function schedule()
  {
    $data=$this->MainData();
    return view('dashboard/add_schedule', $data);
  }

  public function budgets()
  {
    $data=$this->MainData();
    return view('dashboard/add_budgets', $data);
  }

  public function MainData(){
    date_default_timezone_set('Asia/Ulaanbaatar');
    $data['y_8']=date('Y-m-d', strtotime( '-7 days' ) );
    $data['y']=date('Y-m-d', strtotime( '-1 days' ) );
    $data['today']=date('Y-m-d');
    $data['date14']=date('Y-m-d', strtotime( '+2 days' ) );
    $data['sites'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
    return $data;
  }
}
