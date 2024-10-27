<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dispatch;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getEvent(Request $request){
        if($request->worker_id){
            $worker_id=$request->worker_id;
            $place=$request->place;
            $date=$request->date;
            $title=$request->title;
            $dispatchs=Dispatch::query()->where("worker_id",$worker_id)->get();
            $result=[];
            $events=[];
            foreach($dispatchs as $dispatch){
                $events[]=Event::query()->where("id",$dispatch->event_id)->first();
            }
            foreach($events as $event){
                $query=Event::query();
                if(isset($place)){
                    $query->where("place",$place);
                }
                if(isset($date)){
                    $query->where("event_date",$date);
                }
                if(isset($title)){
                    $query->where("name","LIKE","%".$title."%");
                }
                $item=$query->find($event->id);
                if($item!=null){
                    $result[]=$item;
                }
            }
            if(!empty($result)){
                return response()->json($result);
            }else{
                return response()->json(["error"=>"エラーが発生しました"],404);
            }
        }else{
            return response()->json(["error"=>"エラーが発生しました"],404);
        }
    }

    public function postEvent(Request $request){
        if($request->worker_id&&$request->event_id){
            $worker_id=$request->worker_id;
            $event_id=$request->event_id;
            $dispatch=Dispatch::query()->where("worker_id",$worker_id)->where("event_id",$event_id)->first();
            $dispatch_id=$dispatch->id;
            // return $dispatch_id;
            if(!empty($dispatch)){
                $update=Dispatch::query()->find($dispatch_id);
                $update->update([
                    "permit"=>true,
                ]);
                return response()->json(["message"=>"承諾済みフラグを更新しました"],204);
            }else{
                return response()->json(["error"=>"エラーが発生しました"],404);
            }
        }else{
            return response()->json(["error"=>"エラーが発生しました"],404);
        }
    }
}
