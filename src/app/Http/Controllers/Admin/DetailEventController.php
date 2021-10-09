<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class DetailEventController extends Controller
{
    function index(Request $request){
        $event = Event::find($request->eventId);

        $participant_list = Event::select('users.*','event_attendances.comment','events.name as event_name,events.status_id')->crossJoin('users')->leftJoin('event_attendances', function ($join) {
            $join->on('event_attendances.event_id', '=', 'events.id')->on('event_attendances.user_id', '=', 'users.id');
        })->where('events.id',$request->eventId)->where('event_attendances.status_id',1)->get();
        $nonParticipant_list = Event::select('users.*','event_attendances.comment','events.name as event_name')->crossJoin('users')->leftJoin('event_attendances', function ($join) {
            $join->on('event_attendances.event_id', '=', 'events.id')->on('event_attendances.user_id', '=', 'users.id');
        })->where('events.id',$request->eventId)->where('event_attendances.status_id',2)->get();

        $submitted_list = Event::select('users.*','event_attendances.comment','events.name as event_name')->crossJoin('users')->leftJoin('event_attendances', function ($join) {
            $join->on('event_attendances.event_id', '=', 'events.id')->on('event_attendances.user_id', '=', 'users.id');
        })->where('events.id',$request->eventId)->where('event_attendances.status_id',3)->get();

        $notSubmitted_list = Event::select('users.*','events.name as event_name')->crossJoin('users')->leftJoin('event_attendances', function ($join) {
            $join->on('event_attendances.event_id', '=', 'events.id')->on('event_attendances.user_id', '=', 'users.id');
        })->where('events.id',$request->eventId)->where('event_attendances.status_id',null)->get();

        return view('admin.event_detail',compact('event','participant_list','nonParticipant_list','notSubmitted_list','submitted_list'));
    }
}
