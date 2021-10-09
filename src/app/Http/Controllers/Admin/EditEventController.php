<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;


class EditEventController extends Controller
{
    public function edit($eventId)
    {
        $event_info  = Event::select('events.*')->where('events.id', $eventId)->get();
        return view('admin.event_edit', compact('event_info'));
    }
    
    public function delete($eventId)
    {
        Event::where('id', $eventId)->delete();
        return redirect('/admin/list-event');
    }
}
