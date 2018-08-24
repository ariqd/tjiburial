<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'slug', 'price', 'overview', 'facilities', 'amenities', 'specials', 'max_guest', 'installment',
        'featured', 'type', 'price_weekend'
    ];

    public function photos()
    {
        return $this->hasMany('App\RoomPhoto');
    }
}
