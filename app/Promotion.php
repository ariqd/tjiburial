<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function images()
    {
        return $this->hasMany('App\PromotionImage');
    }
}
