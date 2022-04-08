<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // поля, которые мы разрешим заполнять
    protected $fillable = [
        'room_id',
        'start',
        'end',
        'is_reservation',
        'is_paid',
        'notes',
    ];
}
