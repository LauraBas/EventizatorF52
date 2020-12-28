<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function events() :BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function enrollToEvent($eventId) :bool
    {
        $userEvents = $this->events()->find($eventId);
        $event = Event::find($eventId);

        if ($event->capacity > $event->participants)
        {
            if (is_null($userEvents))
            {
                $this->events()->attach($eventId);
                DB::table('events')->increment('participants', 1, ['id' => $eventId]);
                return true;
            }
            return false;
        }
        return false;
    }
}
