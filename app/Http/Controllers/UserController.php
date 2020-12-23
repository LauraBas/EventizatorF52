<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        }
    }
}
