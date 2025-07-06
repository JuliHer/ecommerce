<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'venue',
        'location',
        'tickets_url',
        'sold_out',
    ];

    protected $casts = [
        'date' => 'date',
        'sold_out' => 'boolean',
    ];

    protected function date() : Attribute {
        return Attribute::make(
            get: function ($value){
                return Carbon::parse($value)->translatedFormat('F d, Y');
            }
        );
    }
}
