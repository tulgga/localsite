<?php
namespace App\Http\Controllers;

use App\Dashboard_news;
use App\Dashboard_budget;
use App\Dashboard_schedule;
use App\Dashboard_police;
use App\Dashboard_hospital;
use App\Dashboard_nema;
use App\Site;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Dashboard extends Controller
{
  public function index($site_id=0, $user_role=0)
  {
      $data=$this->MainData();
      $data['site'] = Site::find($site_id); // site
      $data['events'] = []; // event
      $hospital_data = null; // hospital
      $nema_data = null; // hospital
      $police_data = null; // hospital
      $data['news'] = [];

      if($site_id==0){ // аймаг

          $data['events']= Dashboard_schedule::select('*')->whereNotIn('head_id',[1,2,3])->where('schedule_date','>=', date('Y-m-d'))->orderBy('id', 'DESC')->limit(8)->get();
          $data['schedule']= Dashboard_schedule::select('*')->whereNotIn('head_id',[4,5,6,7,8,9])->where('schedule_date','>=', date('Y-m-d'))->orderBy('start_time', 'ASC')->get();
          $data['news']= Dashboard_news::select('*')->where('created_at', '>=', $data['y'])->orderBy('created_at', 'DESC')->get();
          $hospital_data = Dashboard_hospital::select(DB::raw('SUM(birth) as birth'),
              DB::raw('SUM(die) as die'),
              DB::raw('SUM(call_near) as call_near'),
              DB::raw('SUM(call_remote) as call_remote'),
              DB::raw('SUM(inspection) as inspection'),
              DB::raw('SUM(ytt) as ytt')
              )->whereDate('hospical_date', '>', Carbon::now()->subDays(1))->groupBy('hospical_date')->first();

          $hospitalChart = Dashboard_hospital::select(DB::raw('MONTH(hospical_date) as month'),
              DB::raw('DAY(hospical_date) as day'),
              DB::raw('SUM(birth) as birth'),
              DB::raw('SUM(die) as die'),
              DB::raw('SUM(call_near) as call_near'),
              DB::raw('SUM(call_remote) as call_remote'),
              DB::raw('SUM(inspection) as inspection'),
              DB::raw('SUM(ytt) as ytt')
              )->whereDate('hospical_date', '>', Carbon::now()->subDays(7))->groupBy('hospical_date')->get();
          $policeData = Dashboard_police::select(
              DB::raw('SUM(crime_kill) as crime_kill'),
              DB::raw('SUM(crime_theft) as crime_theft'),
              DB::raw('SUM(crime_movement) as crime_movement'),
              DB::raw('SUM(crime_other) as crime_other'),
              DB::raw('SUM(ac_family) as ac_family'),
              DB::raw('SUM(ac_healing) as ac_healing'),
              DB::raw('SUM(ac_arrest) as ac_arrest'),
              DB::raw('SUM(ac_fine) as ac_fine'),
              DB::raw('SUM(ac_other) as ac_other')
          )->whereDate('police_date', '>', Carbon::now()->subDays(1))->groupBy('police_date')->first();
          $policeChart = Dashboard_police::select(DB::raw('MONTH(police_date) as month'),
              DB::raw('DAY(police_date) as day'),
              DB::raw('SUM(crime_kill) as crime_kill'),
              DB::raw('SUM(crime_theft) as crime_theft'),
              DB::raw('SUM(crime_movement) as crime_movement'),
              DB::raw('SUM(crime_other) as crime_other'),
              DB::raw('SUM(ac_family) as ac_family'),
              DB::raw('SUM(ac_healing) as ac_healing'),
              DB::raw('SUM(ac_arrest) as ac_arrest'),
              DB::raw('SUM(ac_fine) as ac_fine'),
              DB::raw('SUM(ac_other) as ac_other')
              )->whereDate('police_date', '>', Carbon::now()->subDays(7))->groupBy('police_date')->get();
          $nemaData = Dashboard_nema::select(DB::raw('SUM(fo) as fo'),
              DB::raw('SUM(ff) as ff'),
              DB::raw('SUM(sos) as sos')
          )->whereDate('nema_date', '>', Carbon::now()->subDays(1))->groupBy('nema_date')->first();
          $nemaChart = Dashboard_nema::select(DB::raw('MONTH(nema_date) as month'),
              DB::raw('DAY(nema_date) as day'),
              DB::raw('SUM(fo) as fo'),
              DB::raw('SUM(ff) as ff'),
              DB::raw('SUM(sos) as sos')
              )->whereDate('nema_date', '>', Carbon::now()->subDays(7))->groupBy('nema_date')->get();

          $data['policeChart'] = $policeChart;
          $data['hospitalChart'] = $hospitalChart;
          $data['nemaChart'] = $nemaChart;


      }else{ // sum

      }
      $data['h'] = $hospital_data;
      $data['p'] = $policeData;
      $data['n'] = $nemaData;
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
    $data['today_md'] = date('m/d');
    $data['today']=date('Y-m-d');
    $data['date14']=date('Y-m-d', strtotime( '+1 days' ) );
    $data['sites'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
    return $data;
  }
}
