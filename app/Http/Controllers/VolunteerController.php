<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Event;
use App\Event_to_comment;
use App\Event_to_image;
use App\Event_to_rating;
use App\Event_to_like;
use App\Event_to_user;

use App\Organization;
use App\User_to_organization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Site;
use App\User;
use App\User_social;

class VolunteerController extends Controller{
    public function index(){
        $data['events'] = Event::select('events.subject','events.content','event_to_images.image','events.started','events.ended','events.id',DB::raw('AVG(event_to_ratings.rating) as rate'))
            ->where('status', 1)
            ->leftJoin('event_to_ratings','event_to_ratings.event_id','=','events.id')
            ->Join('event_to_images','event_to_images.event_id', '=','events.eid')
            ->groupBy('event_to_images.event_id')
            ->orderBy('events.created_at', 'desc')
            ->limit(8)
            ->get();
        //echo json_encode($data['events']); die;
        return view('volunteer.home', $data);
    }
    public function eventlist(){
        $paginate=80;
        $data['events'] = Event::select('events.subject','events.content','event_to_images.image','events.started','events.ended','events.id',DB::raw('AVG(event_to_ratings.rating) as rate'))
            ->where('status', 1)
            ->leftJoin('event_to_ratings','event_to_ratings.event_id','=','events.id')
            ->Join('event_to_images','event_to_images.event_id', '=','events.eid')
            ->groupBy('event_to_images.event_id')
            ->orderBy('events.created_at', 'desc')
            ->paginate($paginate);
        return view('volunteer.eventlist', $data);
    }
    public function event($id){
        $data['event'] = Event::select('*')->where('id', $id)->first();
        $data['createUser'] = User::select('lastname','firstname','profile_pic')->where('id', $data['event']->created_user_id)->first();
        $data['likes'] = Event_to_like::select(DB::raw('COUNT(*) as counts'))->where('event_id',$id)->first();
        $data['rating'] = Event_to_rating::select(DB::raw('AVG(event_to_ratings.rating) as rate'))->where('event_id',$id)->first();
        $data['images'] = Event_to_image::select('image')->where('event_id',$data['event']->eid)->get();
        //echo json_encode($data['events']); die;
        return view('volunteer.single', $data);
    }
    public function login(){
        if(!is_null(Auth::user())){
            return redirect()->to('/login');
        }else {
            return view('volunteer.login');
        }
    }
    public function register(){
        $data['site'] = Site::select('id','name')->orderBy('name','ASC')->get();
        return view('volunteer.register',$data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userRegister(Request $request){
        $data = $request->post();
        $validator = Validator::make($data, [
            'name' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'verify_password' => 'required|same:password',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|unique:users|digits:8'
        ]);

        if ($validator->fails()) {
                $error = $validator->errors();
                $request->session()->flash('nameerror', $error->first('name'));
                $request->session()->flash('passworderror', $error->first('password'));
                $request->session()->flash('verify_password', $error->first('verify_password'));
                $request->session()->flash('emailerror', $error->first('email'));
                $request->session()->flash('phoneerror', $error->first('phone'));
                $request->session()->flash('username',$request->name);
                $request->session()->flash('lastname',$request->lastname);
                $request->session()->flash('firstname',$request->firstname);
                $request->session()->flash('site_id',$request->site_id);
                $request->session()->flash('email',$request->email);
                $request->session()->flash('phone',$request->phone);
                $request->session()->flash('registration_no',$request->registration_no);
                return redirect()->to('/register');
        }
        $register = $request->registration_no;
        $year = $register[4].$register[5];
        $month = $register[6].$register[7];
        $day = $register[8].$register[9];
        $gender = $register[10]%2;
        if($month > 12){
            $year = 2000+$year;
            $month -= 20;
        }else{
            $year = 1900+$year;
        }

        $user = New User();
        $pass = bcrypt($request->verify_password);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->registration_no = $request->registration_no;
        $user->site_id = $request->site_id;
        $user->password = $pass;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->is_set_rd = 1;
        $user->is_volunteer = 1;

        $user->gender = $gender;
        $user->birth_date = $year."-".$month."-".$day;
        $user->save();
        $request->session()->flash('successMsg', 'Бүртгэл амжилттай хадгалагдлаа!');
        return redirect()->to('/register');

    }
    public function profile(){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $data['site'] = Site::select('id', 'name')->orderBy('name', 'ASC')->get();
            $social = User_social::select('*')->where('user_id',Auth::user()->id)->first();
            if(is_null($social)){
                $data['facebook'] = "";
                $data['twitter'] = "";
                $data['instagram'] = "";
                $data['linkedin'] = "";
            }else{
                $data['facebook'] = $social->facebook;
                $data['twitter'] = $social->twitter;
                $data['instagram'] = $social->instagram;
                $data['linkedin'] = $social->linkedin;
            }
            return view('volunteer.profile', $data);
        }
    }
    public function profileUpdate(Request $request){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $user = User::find(Auth::user()->id);

            if (!is_null($request->file('profile_pic'))) {
                $user->profile_pic = $request->file('profile_pic')->store('users');
            }
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->firstname = $request->firstname;
            $user->registration_no = $request->registration_no;
            $user->site_id = $request->site_id;
            $user->save();
            $request->session()->flash('successMsg', 'Мэдээллийг амжилттай хадгаллаа!');
            return redirect()->to('/profile');
        }
    }
    public function changePassword(){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            return view('volunteer.changepassword');
        }
    }
    public function updatePassword(Request $request){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            if($request->password == $request->verify_password) {
                $user = User::find(Auth::user()->id);
                $user->password = bcrypt($request->verify_password);
                $user->save();
                $request->session()->flash('successMsg', 'Нууц үг амжилттай солигдлоо.');
                return redirect()->to('/changePassword');
            }else{
                $request->session()->flash('errorMsg', 'Нууц үг таарсангүй.');
                return redirect()->to('/changePassword');
            }
        }
    }
    public function socialsave(Request $request){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
                $result = User_social::select('id')->where('user_id',Auth::user()->id)->first();
                if(is_null($result)){
                    $social = New User_social();
                }else{
                    $social = User_social::find($result->id);
                }
                $social->user_id = Auth::user()->id;
                $social->facebook = $request->facebook;
                $social->twitter = $request->twitter;
                $social->instagram = $request->instagram;
                $social->linkedin = $request->linkedin;
                $social->save();
                $request->session()->flash('successMsg', 'Мэдээллийг амжилттай хадгаллаа!');
                return redirect()->to('/profile');
        }
    }
    public function events(){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $data['events'] = Event::select('*')->where('created_user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('volunteer.events',$data);
        }
    }
    public function eventform($id){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            if($id) {
                $events = Event::select('*')->where('created_user_id', Auth::user()->id)->where('id', $id)->first();
                $data['images'] = Event_to_image::select('*')->where('event_id', $events->eid)->orderBy('created_at', 'desc')->get();
                $data['subject'] = $events->subject;
                $data['started'] = $events->started;
                $data['ended'] = $events->ended;
                $data['content'] = $events->content;
                $data['id'] = $id;
            }else{
                $data['id'] = $id;
                $data['images'] = "";
                $data['subject'] = "";
                $data['started'] = "";
                $data['ended'] = "";
                $data['content'] = "";
            }
            return view('volunteer.createevents',$data);
        }
    }
    public function saveEvent(Request $request){

        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            if($request->id == "0") {
                $event = New Event();
                $eid = rand(10000000, 99999999);
                $event->eid = $eid;
                $event->subject = $request->subject;
                $event->started = $request->started;
                $event->ended = $request->ended;
                $event->content = $request->contentHTML;
                $event->created_user_id = Auth::user()->id;
                $event->save();
                if (is_null($request->images)){
                }else{
                    foreach ($request->images as $key => $value) {
                        $image = New Event_to_image();
                        $image->event_id = $eid;
                        $image->image = $value->store('events');
                        $image->save();
                    }

                }
            }else{
                $event = Event::find($request->id);
                $event->subject = $request->subject;
                $event->started = $request->started;
                $event->ended = $request->ended;
                $event->content = $request->contentHTML;
                $event->save();
                if (is_null($request->images)) {
                }else{
                    foreach ($request->images as $key => $value) {
                        $image = New Event_to_image();
                        $image->event_id = $event->eid;
                        $image->image = $value->store('events');
                        $image->save();
                    }

                }
            }
            $request->session()->flash('successMsg', 'Мэдээллийг амжилттай хадгаллаа!');
            return redirect()->to('/events');
        }
    }
    public function organization(){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $data['events'] = Organization::select('*')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            return view('volunteer.organization',$data);
        }
    }
    public function organizationform($id){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $data['site'] = Site::select('id', 'name')->orderBy('name', 'ASC')->get();
            if($id) {
                $orga = Organization::select('*')->where('user_id', Auth::user()->id)->where('id', $id)->first();
                $data['name'] = $orga->name;
                $data['sum'] = $orga->sum;
                $data['bag'] = $orga->bag;
                $data['address'] = $orga->address;
                $data['phone'] = $orga->phone;
                $data['email'] = $orga->email;
                $data['web'] = $orga->web;
                $data['social_link'] = $orga->social_link;
                $data['logo'] = $orga->logo;
                $data['id'] = $id;
            }else{
                $data['id'] = $id;
                $data['name'] = "";
                $data['sum'] = "";
                $data['bag'] = "";
                $data['address'] = "";
                $data['phone'] = "";
                $data['email'] = "";
                $data['web'] = "";
                $data['social_link'] = "";
                $data['logo'] = "";
            }
            return view('volunteer.organizationform', $data);
        }
    }
    public function organizationUpdate(Request $request){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            if($request->id == 0){
                $orga = New Organization();
            } else {
                $orga = Organization::find($request->id);
            }
            die;
            if (is_null($request->logo)) {
            }else{
                $orga->logo = $request->logo->store('company_logo');
            }
            $orga->name = $request->name;
            $orga->sum = $request->sum;
            $orga->bag = $request->bag;
            $orga->address = $request->address;
            $orga->phone = $request->phone;
            $orga->email = $request->email;
            $orga->web = $request->web;
            $orga->social_link = $request->social_link;
            $orga->save();
            $request->session()->flash('successMsg', 'Мэдээллийг амжилттай хадгаллаа!');
            return redirect()->to('/organization');
        }
    }
    public function organizationUpdateStatus($id,$stat){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $event = Organization::find($id);
            $event->status = $stat;
            $event->save();
            return redirect()->to('/organization');
        }
    }
    public function eventUpdateStatus($id,$stat){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $event = Event::find($id);
            $event->status = $stat;
            $event->save();
            return redirect()->to('/events');
        }
    }
    public function eventdelete(Request $request,$id){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $event = Event::select('eid')->where('created_user_id', Auth::user()->id)->where('id', $id)->first();
            $images = Event_to_image::select('id','image')->where('event_id', $event->eid)->get();
            if($images) {
                foreach ($images as $img) {
                    $delete = unlink('uploads/'.$img->image);
                    if($delete){
                        $image = Event_to_image::find($img->id);
                        $image->delete();
                    }
                }
            }
            $events = Event::find($id);
            $events->delete();
            $request->session()->flash('successMsg', 'Мэдээллийг амжилттай устгалаа!');
            return redirect()->to('/events');
        }
    }
    public function deleteImg(Request $request, $img_id, $event){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        }else{
            $img = Event_to_image::select('image')->where('id', $img_id)->first();
            $delete = unlink('uploads/'.$img->image);
            if($delete){
                $images = Event_to_image::find($img_id);
                $images->delete();
                $request->session()->flash('successMsg', 'Зураг устгагдлаа!');
                return redirect()->to('/eventform/'.$event);
            }else{
                $request->session()->flash('errorMsg', 'Устгахад алдаа гарлаа!');
                return redirect()->to('/eventform/'.$event);
            }
        }
    }

    public function loginUser(Request $request){

        if(is_numeric($request['username'])){
            $check=['phone'=>$request['username'], 'password'=>$request['password']];
        } elseif (filter_var($request['username'], FILTER_VALIDATE_EMAIL)) {
            $check= ['email' => $request['username'], 'password'=>$request['password']];
        } else {
            $check=['name' => $request['username'], 'password'=>$request['password']];
        }

        if (Auth::attempt($check)) {
            $user = Auth::user();
            if($user->status == 0){

                Auth::logout();
                $request->session()->flash('loginMsg', 'Та эрхээ баталгаажуулаагүй байна.');
                return redirect()->to('/login');
            }elseif($user->status == 1){
                $request->session()->get('user_id', $user->id);
                $request->session()->get('logged_id', true);
                return redirect()->to('/');
            }

        } else {
            $request->session()->flash('loginMsg', 'Хэрэглэгчийн нэр эсвэл нууц үг буруу байна!');
            return redirect()->to('/login');
        }
    }
    public function logoutUser(){
        Auth::logout();
        return redirect()->to('/');
    }
    public function event_like(Request $request){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        } else {
            $like = Event_to_like::select('id')->where('user_id',Auth::user()->id)->where('event_id',$request->event_id)->first();
            if($like) {
                $unlike = Event_to_like::find($like->id);
                $unlike->delete();
                return response()->json(['result' => 'unlike', '_token' => csrf_token()]);
            }else{
                $liked = New Event_to_like();
                $liked->event_id = $request->event_id;
                $liked->user_id = Auth::user()->id;
                $liked->save();
                return response()->json(['result' => 'like', '_token' => csrf_token()]);
            }
        }
    }
    public function event_rate(Request $request){
        if(is_null(Auth::user())){
            return redirect()->to('/login');
        } else {
            $rating = Event_to_rating::select('id')->where('user_id',Auth::user()->id)->where('event_id',$request->event_id)->first();
            if($rating) {
                $rate = Event_to_rating::find($rating->id);
            }else{
                $rate = New Event_to_rating();
            }
            $rate->user_id = Auth::user()->id;
            $rate->event_id = $request->event_id;
            $rate->rating = $request->value;
            $rate->save();
            return response()->json(['success' => 'true', '_token' => csrf_token()]);
        }
    }
}
