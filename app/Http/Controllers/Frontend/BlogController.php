<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $data['blogs'] = Blog::all();
        return view('frontend.blog.blog', $data);
    }

    public function show($id)
    {
        $data['blog'] = Blog::find($id);
        return view('frontend.blog.detail', $data);
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
