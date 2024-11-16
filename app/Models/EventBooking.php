<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room',
        'booking_date',
        'start_time',
        'end_time',
        'event_type',
        'event_name',
        'description',
        'status',
        'user_id',
        'name',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
