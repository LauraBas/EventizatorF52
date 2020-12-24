<?php

namespace App\Http\Controllers;

use App\Mail\EnrollEventEmail;
use App\Mail\UnenrollEventEmail;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function enroll($eventId)
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $userEvents = $user->events()->find($eventId);

        if (is_null($userEvents))
        {
            $user->events()->attach($eventId);
            $event = Event::find($eventId);
            Mail::to($user->email)->send(new EnrollEventEmail($event));
            return view('user');
        }
        return view('user');
    }

    public function unenroll($eventId)
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $event = Event::find($eventId);
        $user->events()->find($eventId);
        $user->events()->detach($eventId);
        Mail::to($user->email)->send(new UnenrollEventEmail($event));
        return view('user');
    }
}
