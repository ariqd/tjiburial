<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'room_id', 'user_id', 'check_in', 'duration', 'check_out', 'room_count', 'guest_count', 'total', 'status'
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function booking()
    {
        return $this->hasOne('App\Booking');
    }
}
