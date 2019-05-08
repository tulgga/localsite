<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Event_to_like;
use App\Event_to_image;
use App\Event_to_rating;

class ApiVolunteerController extends Controller
{
    public function eventslist(){
        $events = Event::where('status', 1)->Join('event_to_images','event_to_images.event_id', '=','events.eid')->groupBy('event_to_images.event_id')->orderBy('events.created_at', 'desc')->select('events.subject','events.content','event_to_images.image','events.started','events.ended','events.id')->get();
        return response()->json($events);
    }
    public function event($id){
        $event = Event::select('*')->where('id',$id)->first();
        $images = Event_to_image::select('image')->where('event_id',$event->eid)->get();

        $data = array(
            'subject' => $event->subject,
            'content' => $event->content,
            'started' => $event->started,
            'ended' => $event->ended,
            'created_at' => $event->created_at->format('Y-m-d H:i:s'),
            'images' => $images
        );
        return response()->json($data);
    }
    public function event_like(Request $request){
            $data = $request->post();
            $like = Event_to_like::select('id')->where('user_id',$data['user_id'])->where('event_id',$data['event_id'])->first();
            if($like){
                $unlike = Event_to_like::find($like->id);
                $unlike->delete();
                return response()->json(['success'=>true, 'result' => 'unlike']);
            }else{
                $liked = New Event_to_like();
                $liked->event_id = $data['event_id'];
                $liked->user_id = $data['user_id'];
                $liked->save();
                return response()->json(['success'=>true, 'result' => 'like']);
            }
    }
    public function event_rate(Request $request){
            $data = $request->post();
            $rating = Event_to_rating::select('id')->where('user_id',$data['user_id'])->where('event_id',$data['event_id'])->first();
            if($rating) {
                $rate = Event_to_rating::find($rating->id);
            }else{
                $rate = New Event_to_rating();
                $rate->user_id = $data['user_id'];
            }
            $rate->event_id = $data['event_id'];
            $rate->rating = $data['value'];
            $rate->save();
            return response()->json(['success' => true]);
        }
}
