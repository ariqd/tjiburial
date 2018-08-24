<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'reservation_id', 'title', 'name', 'email', 'dob', 'nationality', 'country', 'state', 'city', 'address',
        'phone_code', 'phone_no'
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
