<?php

namespace App\Http\Controllers;

use App\Mail\EnrollEventEmail;
use App\Mail\UnenrollEventEmail;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function enroll($eventId)
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $event = Event::find($eventId);

        if ($user->enrollToEvent($eventId))
        {
            Mail::to($user->email)->send(new EnrollEventEmail($event));
            return view('responses.enrollResponse', ["message" => "You're enroll in the event " . $event->title]);
        }
        return view('responses.enrollFailedResponse', ["message" => "You're already enroll in the event " . $event->title]);
    }

    public function unenroll($eventId)
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $event = Event::find($eventId);
        $user->unenrollFromEvent($eventId);
        Mail::to($user->email)->send(new UnenrollEventEmail($event));
        return redirect('user');
    }

    public function profile()
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $events = $user->userEvents($userId);
        $pastEvents = [];
        $commingEvents = [];

        foreach($events as $event)
        {
            $now = date('c');
            if ($event->date < $now) 
            {
                array_push($pastEvents, $event);
            }
            else
            {                           
                array_push($commingEvents, $event);
            }             
        }
        return view('user', compact('commingEvents', 'pastEvents'));  
    }
}
