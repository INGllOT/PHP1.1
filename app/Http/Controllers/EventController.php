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

       
        // if (auth()->user()->id !== $event['user_id']) {
        //     return redirect('/');
        // }

        return view('edit-event', ['event' => $event]);
    }

    public function updateEvent(Event $event, Request $request)
    {
        // if (auth()->user()->id !== $event['user_id']) {
        //     return redirect('/');
        // }

        $incomingFields = $request->validate([
            'title'=> 'required',
            'body'=> 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $event->update($incomingFields);
        return redirect('/');
    }

    public function deleteEvent(Event $event)
    {
        // if (auth()->user()->id !== $event['user_id']) {
        //     return redirect('/');
        // }

        $event ->delete();
        return redirect('/');
    }
}
