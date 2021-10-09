<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListEventController extends Controller
{
    public function list()
    {
        return view('admin.event_list');
    }

    public function index(Request $request)
    {
        $user_id = Auth::id();
        $status_id = $request->input('status_id');

        $today = new Carbon('today');

        $today = $today->format('Y-m-d');

        $events = new Event;
        if($status_id==null){
            // 通常時
            $events = $events->with('event_attendances.user')->where('start_at','>=',$today)->orderBy('events.start_at')->get();
        }elseif($status_id=='not_submitted'){
            // 未提出
            $events = $events->with('event_attendances.user')->where('start_at','>=',$today)->whereDoesntHave('event_attendances', function (Builder $query)use($user_id){$query->where('user_id',$user_id);})->orderBy('events.start_at')->get();
        }else{
            // 参加or不参加
            $events = $events->with('event_attendances.user')->whereHas('event_attendances', function($query)use($user_id,$status_id){$query->where('status_id',$status_id)->where('user_id',$user_id);})->where('start_at','>=',$today)->orderBy('events.start_at')->get();
        }

        return view('admin.event_list', compact('events','status_id'));
    }
}
