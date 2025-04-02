<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade

class EventController extends Controller
{
    public function createEvent(Request $request)
    {


        $request['user_id'] = auth()->id();
        Event::create($request->all());

        return redirect('/');
    }



    public function showEventController(Event $event)
    {
        return view('edit-event', ['event' => $event, 'categories' => Category::all()]);
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
            'description' => 'required',
            'place' => 'required',
            'ticket_price' => 'required|numeric',
            'ticket_quantity' => 'required|integer',
            'event_date' => 'required',
            'ticket_start_date' => 'required',
            'ticket_end_date' => 'required',
            'category' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['description'] = strip_tags($incomingFields['description']);

        $event->update($incomingFields);
        return redirect('/');
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect('/');
    }
}
