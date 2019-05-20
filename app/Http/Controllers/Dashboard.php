<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Dashboard_news;
use App\Dashboard_budget;
use App\Dashboard_schedule;
use App\Dashboard_police;
use App\Dashboard_hospital;
use App\Dashboard_nema;
use App\Site;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    use AuthenticatesUsers;

    public function guard()
    {
        return Auth::guard('admin');
    }
    public function index($site_id=0,$role=0){
        $user = Auth::guard('admin')->user();
        if(is_null($user)){
            return redirect()->to('login');
        }else {
            if ($role == $user->admin_type || $site_id == $user->site_id) {
                $data = $this->MainData();
                $data['site'] = Site::find($site_id); // site
                if ($site_id == 0) { // аймаг

                    $data['events'] = Dashboard_schedule::select('*')->whereNotIn('head_id', [1, 2, 3])->where('schedule_date', '>=', date('Y-m-d'))->orderBy('id', 'DESC')->limit(8)->get();
                    $data['schedule'] = Dashboard_schedule::select('*')->whereNotIn('head_id', [4, 5, 6, 7, 8, 9])->where('schedule_date', '>=', date('Y-m-d'))->orderBy('start_time', 'ASC')->get();
                    $data['news'] = Dashboard_news::select('*')->where('created_at', '>=', $data['y'])->orderBy('created_at', 'DESC')->get();
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

                } else { // sum
                    $data['events'] = Dashboard_schedule::select('*')->where('site_id', $site_id)->whereNotIn('head_id', [1, 2, 3])->where('schedule_date', '>=', date('Y-m-d'))->orderBy('id', 'DESC')->limit(8)->get();
                    $data['schedule'] = Dashboard_schedule::select('*')->where('site_id', $site_id)->whereNotIn('head_id', [4, 5, 6, 7, 8, 9])->where('schedule_date', '>=', date('Y-m-d'))->orderBy('start_time', 'ASC')->get();
                    $data['news'] = Dashboard_news::select('*')->where('site_id', $site_id)->where('created_at', '>=', $data['y'])->orderBy('created_at', 'DESC')->get();
                    $hospital_data = Dashboard_hospital::select(DB::raw('SUM(birth) as birth'),
                        DB::raw('SUM(die) as die'),
                        DB::raw('SUM(call_near) as call_near'),
                        DB::raw('SUM(call_remote) as call_remote'),
                        DB::raw('SUM(inspection) as inspection'),
                        DB::raw('SUM(ytt) as ytt')
                    )->where('site_id', $site_id)->whereDate('hospical_date', '>', Carbon::now()->subDays(1))->groupBy('hospical_date')->first();

                    $hospitalChart = Dashboard_hospital::select(DB::raw('MONTH(hospical_date) as month'),
                        DB::raw('DAY(hospical_date) as day'),
                        DB::raw('SUM(birth) as birth'),
                        DB::raw('SUM(die) as die'),
                        DB::raw('SUM(call_near) as call_near'),
                        DB::raw('SUM(call_remote) as call_remote'),
                        DB::raw('SUM(inspection) as inspection'),
                        DB::raw('SUM(ytt) as ytt')
                    )->where('site_id', $site_id)->whereDate('hospical_date', '>', Carbon::now()->subDays(7))->groupBy('hospical_date')->get();
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
                    )->where('site_id', $site_id)->whereDate('police_date', '>', Carbon::now()->subDays(1))->groupBy('police_date')->first();
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
                    )->where('site_id', $site_id)->whereDate('nema_date', '>', Carbon::now()->subDays(1))->groupBy('nema_date')->first();
                    $nemaChart = Dashboard_nema::select(DB::raw('MONTH(nema_date) as month'),
                        DB::raw('DAY(nema_date) as day'),
                        DB::raw('SUM(fo) as fo'),
                        DB::raw('SUM(ff) as ff'),
                        DB::raw('SUM(sos) as sos')
                    )->where('site_id', $site_id)->whereDate('nema_date', '>', Carbon::now()->subDays(7))->groupBy('nema_date')->get();
                }
                $data['policeChart'] = $policeChart;
                $data['hospitalChart'] = $hospitalChart;
                $data['nemaChart'] = $nemaChart;
                $data['h'] = $hospital_data;
                $data['p'] = $policeData;
                $data['n'] = $nemaData;
                if($user->admin_type == 15) {
                    if($site_id == 0) {
                        $data['budgets'] = Dashboard_budget::where('site_id', $site_id)->whereIn('b_type', [1,2,3,4])->orderBy('id', 'DESC')->get();
                    }else{
                        $data['budgets'] = Dashboard_budget::where('site_id', $site_id)->whereIn('b_type', [1,2,4])->orderBy('id', 'DESC')->get();
                    }
                }else{
                    if($site_id == 0) {
                        $data['budgets'] = Dashboard_budget::where('site_id', $site_id)->whereIn('b_type', [1,2,3])->orderBy('id', 'DESC')->get();
                    }else{
                        $data['budgets'] = Dashboard_budget::where('site_id', $site_id)->whereIn('b_type', [1,2])->orderBy('id', 'DESC')->get();
                    }
                }
                $data['user'] = $user;
                return view('dashboard/index', $data);
            }else{
                return redirect()->to('logout');
            }
        }
    }
  public function login(){
      if(is_null(Auth::guard('admin')->user())){
        return view('dashboard/login');
      }else{
          return redirect()->to('/');
      }
  }
    public function loginCheck(Request $request){

        $username = $request['user_name'];
        $password = $request['password'];

        $admin = Admin::where('user_name',$username)->whereIn('admin_type',[15,16,17])->first();

        if($admin && $admin->status == 1){
            if(Auth::guard('admin')->attempt(['user_name' => $username, 'password' => $password])){
                $user = Auth::guard('admin')->user();
                return redirect()->to($user->site_id.'/'.$user->admin_type);
            }
            else{
                $request->session()->flash('resultMsg', 'Нэр эсвэл нууц үг буруу байна.');
                return redirect()->to('login');
            }
        } else {
                $request->session()->flash('resultMsg', 'Нэр эсвэл нууц үг буруу байна.');
                return redirect()->to('login');
        }
    }
  public function logout(){
      $this->guard('admin')->logout();
      return redirect()->to('login');
  }
  public function public($site_id=0){
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

      }else{ // sum
          $data['events']= Dashboard_schedule::select('*')->where('site_id',$site_id)->whereNotIn('head_id',[1,2,3])->where('schedule_date','>=', date('Y-m-d'))->orderBy('id', 'DESC')->limit(8)->get();
          $data['schedule']= Dashboard_schedule::select('*')->where('site_id',$site_id)->whereNotIn('head_id',[4,5,6,7,8,9])->where('schedule_date','>=', date('Y-m-d'))->orderBy('start_time', 'ASC')->get();
          $data['news']= Dashboard_news::select('*')->where('site_id',$site_id)->where('created_at', '>=', $data['y'])->orderBy('created_at', 'DESC')->get();
          $hospital_data = Dashboard_hospital::select(DB::raw('SUM(birth) as birth'),
              DB::raw('SUM(die) as die'),
              DB::raw('SUM(call_near) as call_near'),
              DB::raw('SUM(call_remote) as call_remote'),
              DB::raw('SUM(inspection) as inspection'),
              DB::raw('SUM(ytt) as ytt')
          )->where('site_id',$site_id)->whereDate('hospical_date', '>', Carbon::now()->subDays(1))->groupBy('hospical_date')->first();

          $hospitalChart = Dashboard_hospital::select(DB::raw('MONTH(hospical_date) as month'),
              DB::raw('DAY(hospical_date) as day'),
              DB::raw('SUM(birth) as birth'),
              DB::raw('SUM(die) as die'),
              DB::raw('SUM(call_near) as call_near'),
              DB::raw('SUM(call_remote) as call_remote'),
              DB::raw('SUM(inspection) as inspection'),
              DB::raw('SUM(ytt) as ytt')
          )->where('site_id',$site_id)->whereDate('hospical_date', '>', Carbon::now()->subDays(7))->groupBy('hospical_date')->get();
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
          )->where('site_id',$site_id)->whereDate('police_date', '>', Carbon::now()->subDays(1))->groupBy('police_date')->first();
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
          )->where('site_id',$site_id)->whereDate('nema_date', '>', Carbon::now()->subDays(1))->groupBy('nema_date')->first();
          $nemaChart = Dashboard_nema::select(DB::raw('MONTH(nema_date) as month'),
              DB::raw('DAY(nema_date) as day'),
              DB::raw('SUM(fo) as fo'),
              DB::raw('SUM(ff) as ff'),
              DB::raw('SUM(sos) as sos')
          )->where('site_id',$site_id)->whereDate('nema_date', '>', Carbon::now()->subDays(7))->groupBy('nema_date')->get();
      }
      $data['policeChart'] = $policeChart;
      $data['hospitalChart'] = $hospitalChart;
      $data['nemaChart'] = $nemaChart;
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
      return view('dashboard/public', $data);
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
