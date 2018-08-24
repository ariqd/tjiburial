<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    protected $fillable = [
        'room_id', 'image', 'main'
    ];

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
