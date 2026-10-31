<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'room_slug',
        'power',
        'status',
        'current_user_name',
        'current_user_nim',
        'started_at',
        'ends_at',
        'booking_id',
    ];

    protected function casts(): array
    {
        return [
            'power' => 'float',
            'started_at' => 'datetime',
            'ends_at' => 'datetime',
            'booking_id' => 'integer',
        ];
    }
}