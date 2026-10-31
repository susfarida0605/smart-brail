<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'temperature',
        'humidity',
        'power',
        'people',
        'status',
        'light_on',
    ];

    protected function casts(): array
    {
        return [
            'temperature' => 'float',
            'humidity' => 'float',
            'power' => 'float',
            'people' => 'integer',
            'light_on' => 'boolean',
        ];
    }
}