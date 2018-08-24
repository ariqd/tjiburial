<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionImage extends Model
{
    protected $fillable = [
        'promotion_id', 'image', 'main'
    ];

    public function promotion()
    {
        return $this->belongsTo('App\Promotion');
    }
}
