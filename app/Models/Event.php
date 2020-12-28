<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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

}
