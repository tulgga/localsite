<?php

namespace App\Http\Controllers\Api;

use App\Model\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Group;
use App\Model\Group_user;
use Illuminate\Support\Facades\Auth;
use App\Model\Messages;
use Sabberworm\CSS\Value\URL;
use Illuminate\Pagination\Paginator;


class ApiGroupController extends Controller
{

    public function myGroupAdmin(){
        $user=Auth::user();
        $query="
            select groups.*
            from groups
            where groups.status=1 and admin_user_id=".$user->id."
            order by groups.id DESC
        ";
        $results=\DB::select($query);
        foreach ($results as $i=>$result){
            $results[$i]->message= Messages::where('group_id', $result->id)->orderBy('id', 'desc')
                ->join('users', 'users.id','=', 'messages.user_id')
                ->select('messages.*', 'users.name', 'users.profile_pic')
                ->first();
        }
        return response()->json([ 'success' => $results ]);
    }

    public function groupUsers($group_id){

        $results=Group_user::where('group_id', $group_id)
            ->join('users','users.id', '=','group_users.user_id')
            ->select('group_users.group_id', 'group_users.user_id', 'users.name', 'users.profile_pic', 'group_users.status')
        ->orderBy('group_users.created_at','desc')->get();

        foreach ($results as $i=>$result){
            if(!is_null($result->profile_pic)){
                $results[$i]->profile_pic=url('/uploads/'.$result->profile_pic);
            }

        }
        return response()->json([ 'success' => $results ]);
    }

    public function myGroup(){
        $user=Auth::user();
        $query="
            select groups.*
            from groups
            JOIN (
                select group_id, status
                from group_users
                where user_id=".$user->id."
                GROUP by group_id
            ) joined
            on joined.group_id=groups.id
            where joined.status=1
            order by groups.id DESC
        ";
        $results=\DB::select($query);
        foreach ($results as $i=>$result){
            $results[$i]->message= Messages::where('group_id', $result->id)->orderBy('id', 'desc')
                ->join('users', 'users.id','=', 'messages.user_id')
                ->select('messages.*', 'users.name', 'users.profile_pic')
                ->first();
        }
        return response()->json([ 'success' => $results ]);
    }

    public function group(){
        $user=Auth::user();
        $query="
            select groups.*, IFNULL(joined.status, -1) as is_joined
            from groups
            LEFT JOIN (
                select group_id, status
                from group_users
                where user_id=".$user->id."
                GROUP by group_id
            ) joined
            on joined.group_id=groups.id
            where groups.status=1
            order by groups.id DESC
        ";
        $results=\DB::select($query);
        foreach ($results as $i=>$result){
            $results[$i]->message= Messages::where('group_id', $result->id)->orderBy('id', 'desc')
                ->join('users', 'users.id','=', 'messages.user_id')
                ->select('messages.*', 'users.name', 'users.profile_pic')
                ->first();
        }
        return response()->json([ 'success' => $results ]);
    }

    public function outAdminGroup(Request $request){

        $data = $request->post();
        $find=Group_user::where('user_id',$data['user_id'])->where('group_id',$data['group_id'])->first();
        if($find){ $find->delete(); }
        return response()->json([ 'success' => 1 ]);
    }

    public function joinAdminGroup(Request $request){

        $data = $request->post();

        $find=Group_user::where('user_id',$data['user_id'])->where('group_id',$data['group_id'])->first();
        if(!$find){
            $Group_user=new Group_user();
            $Group_user->user_id=$data['user_id'];
            $Group_user->group_id=$data['group_id'];
            $Group_user->save();

        }
        return response()->json([ 'success' => 1 ]);
    }

    public function outGroup(Request $request){
        $user=Auth::user();
        $data = $request->post();

        $find=Group_user::where('user_id',$user->id)->where('group_id',$data['group_id'])->first();
        if($find){ $find->delete(); }
        return response()->json([ 'success' => 1 ]);
    }

    public function joinGroup(Request $request){
        $user=Auth::user();
        $data = $request->post();

        $find=Group_user::where('user_id',$user->id)->where('group_id',$data['group_id'])->first();
        if(!$find){
            $Group_user=new Group_user();
            $Group_user->user_id=$user->id;
            $Group_user->group_id=$data['group_id'];
            $Group_user->save();

        }
        return response()->json([ 'success' => 1 ]);
    }
    public function sendMessage(Request $request){
        $user=Auth::user();
        $data = $request->post();

        $find1=Group::where('id', $data['group_id'])->where('admin_user_id', $user->id)->first();
        $find2=Group_user::where('user_id',$user->id)->where('group_id',$data['group_id'])->where('status', 1)->first();

        if($find1 or $find2){
            $message= new Messages();
            $message->user_id=$user->id;
            $message->group_id=$data['group_id'];
            $message->message=$data['message'];
            $message->ip=$_SERVER['SERVER_ADDR'];
            $message->save();
            return response()->json([ 'success' => 1, 'data'=>$message]);
        }
        return response()->json([ 'success' => 0 ]);
    }

    public function messages($group_id){
        $user=Auth::user();
        $messages=Messages::where('group_id', $group_id)->orderBy('id', 'asc')
            ->join('users', 'users.id','=', 'messages.user_id')
            ->select('messages.*', 'users.name', 'users.profile_pic')
            ->paginate(50);
        $json=json_encode($messages);
        $json=json_decode($json);

       if(!isset($_GET['page'])){
           $currentPage=$json->last_page;
           Paginator::currentPageResolver(function () use ($currentPage) {
               return $currentPage;
           });
           $messages=Messages::where('group_id', $group_id)->orderBy('id', 'asc')
               ->join('users', 'users.id','=', 'messages.user_id')
               ->select('messages.*', 'users.name', 'users.profile_pic')
               ->paginate(50);
       }
       foreach ($messages as $i=>$message){
           if(!is_null($message->profile_pic)){
               $messages[$i]->profile_pic=url('/uploads/'.$message->profile_pic);
           }
           $messages[$i]->is_me=0;
           if($message->user_id==$user->id){$messages[$i]->is_me = 1;}
       }
        return response()->json([ 'success' => $messages ]);
    }
}
