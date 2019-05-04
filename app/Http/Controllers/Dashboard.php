<?php
namespace App\Http\Controllers;

use App\DashboardBudgets;
use App\DashboardHospitals;
use App\DashboardNemas;
use App\DashboardNews;
use App\DashboardPolices;
use App\DashboardSchedules;
use App\DashboardTimeIssues;
use App\Site;

class Dashboard extends Controller
{
  public function index()
  {
      $data=$this->MainData();
      $sum_id=1; // 0 бол аймаг
      $data['yesterday_police'] = DashboardPolices::where('police_date', $data['yesterday'])->first();
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
    $yesterday = date('Y-m-d', strtotime( '-1 days' ) );
    $data['yesterday']=$yesterday;
    $data['sites'] = Site::select('id','name','domain','favicon')->orderBy('name','ASC')->get();
    return $data;
  }
}
