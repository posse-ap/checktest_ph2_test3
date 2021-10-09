<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddEventController extends Controller
{
    public function index(){
        return view('admin.event_add');
    }

    public function add_event(Request $request){
        
        $deadline = $request->deadline ?? $request->end_at;
        $param = [
            'name' => $request->name,
            'detail' => $request->detail,
            'start_at' => $request->start_at, 
            'end_at' => $request->end_at,
            'deadline' => $deadline,
            'questionnaire_id' => $request->questionnaire_id,
        ];
        DB::table('events') -> updateOrInsert(['id' => $request->id] , $param);
        //トップページに遷移する
        return redirect('/admin/add-event');
    }
}
