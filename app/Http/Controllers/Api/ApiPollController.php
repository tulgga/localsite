<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;
use App\Poll_answer;
use Illuminate\Support\Facades\Cookie;

class ApiPollController extends Controller
{
    //Бүх санал асуулга авах
    public function poll(){
        $polls = Poll::orderBy('created_at', 'desc')->paginate(20)->where('status','1');
        return  response()->json(['success' => $polls]);
    }
    //Зөвхөн нэг санал асуулгын ID өгсөн тохиолдолд санал асуулгыг асуулт, хариултын хамт илгээнэ
    public function getById($id)
    {
        $poll= Poll::where('id', $id)->with('Answer')->get();
        return response()->json([ 'success' => $poll ]);
    }

    public function homePoll(){
        $poll= Poll::orderBy('created_at', 'desc')->with('Answer')->first();
        if(strtotime($poll->finish_date)>=time()){
            $poll->finished=false;
        } else {
            $poll->finished=true;
        }


        return response()->json([ 'success' => $poll ]);
    }
    public  function  sendPoll(Request $request){
        $data = $request->get('data');
        $data = json_decode($data, true);
        $poll=Poll::find($data['pollId']);
        if(isset($_COOKIE['poll-'.$data['pollId']])){
            return response()->json([ 'success' => ['type'=>0, 'text'=>'Та саналаа өгсөн байна'] ]);
        } else {
            setcookie('poll-'.$data['pollId'], $data['answerId'], time()+60*60*2);
        }

        if(strtotime($poll->finish_date)>=time()){
            $poll->cnt +=1;
            $poll->save();
            $answer=Poll_answer::find($data['answerId']);
            $answer->cnt +=1;
            $answer->save();
            return response()->json([ 'success' => ['type'=>1, 'text'=>'Саналаа өгсөнд баярлалаа'] ]);
        } else {
            return response()->json([ 'success' => ['type'=>0], 'text'=>'Санал асуулгын хугацаа дууссан байна']);
        }

    }
}
