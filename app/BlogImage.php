<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = [
        'blog_id', 'image', 'main'
    ];

    public function promotion()
    {
        return $this->belongsTo('App\Blog');
    }
}
