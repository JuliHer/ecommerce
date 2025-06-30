<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'status',
        'attended_by',
    ];

    /**
     * Usuario que está atendiendo el mensaje.
     */
    public function attendant()
    {
        return $this->belongsTo(User::class, 'attended_by');
    }

    /**
     * Opcional: estados comunes como helpers.
     */
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_ATTENDED = 'solved';

    /**
     * Devuelve true si el mensaje está en proceso de atención.
     */
    public function isInProgress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    /**
     * Devuelve true si el mensaje ya fue atendido.
     */
    public function isAttended()
    {
        return $this->status === self::STATUS_ATTENDED;
    }
}
