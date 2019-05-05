<?php
namespace App\Http\Controllers;

use App\DashboardBudgets;
use App\DashboardHospitals;
use App\DashboardNemas;
use App\DashboardNews;
use App\DashboardPolices;
use App\DashboardSchedules;
use App\Site;

class Dashboard extends Controller
{
  public function index()
  {
      $data=$this->MainData();
      $sum_id=1; // 0 бол аймаг

      // police
      $data['p'] = null;
      if(DashboardPolices::where('police_date', $data['y'])->first()) {
          $data['p']= DashboardPolices::where('police_date', $data['y'])->first();
      }

      // hospital
      $data['h'] = null;
      if(DashboardHospitals::where('hospical_date', $data['y'])->first()) {
          $data['h']= DashboardHospitals::where('hospical_date', $data['y'])->first();
      }

      // nema
      $data['n'] = null;
      if(DashboardNemas::where('nema_date', $data['y'])->first()) {
          $data['n']= DashboardNemas::where('nema_date', $data['y'])->first();
      }

      // nema
      $data['n'] = null;
      if(DashboardNemas::where('nema_date', $data['y'])->first()) {
          $data['n']= DashboardNemas::where('nema_date', $data['y'])->first();
      }

      // news
      $data['news'] = [];
      if(DashboardNews::where('created_at','>=', $data['y'])->first()) {
          $data['news']= DashboardNews::where('created_at', '>=', $data['y'])->get();
      }

      // budgets
      $data['b'] = [];
      foreach (collect([1, 2, 3, 4]) as $i) {
          if (DashboardBudgets::where('b_type', $i)->get()) {
              array_push($data['b'], DashboardBudgets::where('b_type', $i)->orderBy('id', 'DESC')->first());
          }
      }

      // schedule
      $data['s'] = [];
      $head_id=1;
      if(DashboardSchedules::where('head_id', $head_id)->where('schedule_date','>=', $data['y'])->first()) {
          $data['s']= DashboardSchedules::where('head_id', $head_id)->where('schedule_date','>=', $data['y'])->orderBy('id', 'DESC')->limit(14)->get();
      }

      $data['t'] = [];
      if(DashboardSchedules::whereNotIn('head_id', [1,2,3])->where('schedule_date','>=', $data['y'])->first()) {
          $data['t']= DashboardSchedules::whereNotIn('head_id', [1,2,3])->where('schedule_date','>=', $data['y'])->orderBy('id', 'DESC')->get();
      }


      return view('dashboard/index', $data);
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

  public function nema()
  {
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
    $data['y']=date('Y-m-d', strtotime( '-1 days' ) );
    $w=[];
    array_push($w, date('Y-m-d', strtotime( '-7 days' )));
    array_push($w, date('Y-m-d', strtotime( '-6 days' )));
    array_push($w, date('Y-m-d', strtotime( '-5 days' )));
    array_push($w, date('Y-m-d', strtotime( '-4 days' )));
    array_push($w, date('Y-m-d', strtotime( '-3 days' )));
    array_push($w, date('Y-m-d', strtotime( '-2 days' )));
    array_push($w, date('Y-m-d', strtotime( '-1 days' )));
    $data['week']=$w;
    $data['sites'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
    return $data;
  }
}
