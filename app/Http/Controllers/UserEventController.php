<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserEvent;

class UserEventController extends Controller
{

    public function buyTicket(Request $request) {
        // Walidacja danych wejściowych
        // $request->validate([
        //     'event_id' => 'required|exists:events,id',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|max:255',
        //     'ticket_quantity' => 'required|integer|min:1',
        // ]);
    
        // Pobranie wydarzenia
         $event = $request->event;
    
        // Sprawdzenie dostępności biletów
        // if ($request->ticket_quantity > $event->ticket_quantity) {
        //     return redirect()->back()->with('error', 'Not enough tickets available.');
        // }
    
        // Tworzenie biletu
        UserEvent::create([
            'event_id' => $request->event_id,
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'ticket_quantity' => $request->ticket_quantity
        ]);
    
        // Aktualizacja liczby dostępnych biletów
      //  $event->decrement('ticket_quantity', $request->ticket_quantity);
    
        return redirect('/')->with('success', 'Your ticket has been purchased successfully!');
    }
    
}
