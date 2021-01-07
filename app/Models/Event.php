<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;

    protected $guarded;

    protected $fillable = [
        'title',
        'date',
        'time',
        'description',
        'capacity',
        'requirements',
        'image',
       'isHighlighted',
        'link',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'participants' => 'integer'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function participantsInEvent($id)
    {        
        $usersInEvent= DB::select("SELECT * FROM `users`
                            WHERE `id` IN 
                                (SELECT `user_id` FROM `event_user` 
                                            WHERE `event_id` = $id)");

        $participants = [];
        foreach($usersInEvent as $user)
        {
            array_push($participants, $user->name);
        }
        return $participants;
    }
}