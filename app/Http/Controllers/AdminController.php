<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    public function indexDashboard()
    {
        $events =  DB::table('events')
        ->select(DB::raw('*'))
        ->orderByDesc('date')
        ->paginate(6);

        return view('dashboard', compact('events'));
    }

    public function participants($id)
    {
        $event = Event::find($id);
        $participantsInEvent = $event->participantsInEvent($id);
        return view('participantsInEvent', compact('participantsInEvent', 'event'));
    }
}
