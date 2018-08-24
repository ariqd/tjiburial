<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('frontend.blog.blog');
    }

    public function show($id)
    {
        return view('frontend.blog.detail');
    }

    public function book($id)
    {
        return view('frontend.blog.form');
    }

    public function finish($id)
    {
        return view('frontend.blog.form');
    }
}
