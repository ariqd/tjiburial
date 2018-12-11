<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'slug', 'price', 'overview', 'facilities', 'amenities', 'specials', 'max_guest', 'installment',
        'featured', 'type', 'price_weekend', 'room_count'
    ];

    public function photos()
    {
        return $this->hasMany('App\RoomPhoto');
    }

    public function reservation()
    {
        return $this->hasMany('App\Reservation');
    }
}
