<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEvent;
use App\Models\Event;

class UserEventController extends Controller
{
    public function buyTicketView(Event $event)
    {
        return view('buy-ticket', compact('event'));
    }

    public function userTickets()
    {
        // Pobranie zakupionych biletów przez zalogowanego użytkownika
        $tickets = UserEvent::where('user_id', auth()->id())->get();

        return view('user-tickets', ['tickets' => $tickets ]);
    }

    public function buyTicket(Request $request)
    {
        // Walidacja danych wejściowych
        // $request->validate([
        //     'event_id' => 'required|exists:events,id',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'ticket_quantity' => 'required|integer|min:1',
        // ]);

        // Pobranie wydarzenia
        $event = Event::find($request->event_id);
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }

        // Check if there are enough tickets
        if ($event->ticket_quantity < $request->ticket_quantity) {
            return redirect()->back()->with('error', 'Not enough tickets available.');
        }

        // Tworzenie biletu
        UserEvent::create([
            'event_id' => $request->event_id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'ticket_quantity' => $request->ticket_quantity,
            'event_name' => $event->title,
            'event_description' => $event->description,
            'event_place' => $event->place,
            'ticket_price' => $event->ticket_price,     
            'event_date' => $event->event_date,       
        ]);


        // Aktualizacja liczby dostępnych biletów
        $event->decrement('ticket_quantity', $request->ticket_quantity);

        return redirect('/')->with('success', 'Your ticket has been purchased successfully!');
    }

}
