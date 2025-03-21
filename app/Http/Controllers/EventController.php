<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade

class EventController extends Controller
{
    public function createEvent(Request $request)
    {

        // $incomingFields = $request->validate([
        //     'title' => 'required'
        //     // 'description' => 'required'
        //     // 'place' => 'required'
        //     // 'ticket_price' => 'required',
        //     // 'ticket_quantity' => 'required',
        //     // 'ticket_start_date' => 'required',
        //     // 'ticket_end_date' => 'required',
        //     // 'event_date' => 'required',
        //     // 'category' => 'required'
        // ]);

      //  $incomingFields['description'] = strip_tags($incomingFields['description']);
      //  $incomingFields['user_id'] = auth()->id();
      
        $request['user_id'] = auth()->id();
        Event::create($request->all());

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

    public function showEvent(Event $event)
    {
        return view('show-event', ['event' => $event]);
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
