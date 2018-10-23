<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Poll;

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
}
