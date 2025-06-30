<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'event',
        'location',
        'tickets_url',
        'sold_out',
    ];

    protected $casts = [
        'date' => 'date',
        'sold_out' => 'boolean',
    ];
}
