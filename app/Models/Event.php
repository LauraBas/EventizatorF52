<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
