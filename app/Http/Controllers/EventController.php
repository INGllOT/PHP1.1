<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function createEvent(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'category' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        Event::create($incomingFields);

        return redirect('/');
    }

    public function showEventController(Event $event)
    {
        return view('edit-event', ['event' => $event, 'categories' => Event::$categories]);
    }

    public function printView(Request $request)
    {
        return view('show-event', ['events' => Event::all()]);
    }

    public function updateEvent(Event $event, Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $event->update($incomingFields);
        return redirect('/');
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect('/');
    }
}
