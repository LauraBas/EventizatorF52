<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class AdminController extends Controller
{
    
    public function indexDashboard()
    {
        $events= Event::all(); 

        return view('dashboard', compact('events'));
    }

    public function participants($id)
    {
        $event = Event::find($id);
        $participantsInEvent = $event->participantsInEvent($id);
        return view('participantsInEvent', compact('participantsInEvent', 'event'));
    }
}
