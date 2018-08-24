<?php

namespace App\Http\Controllers\Backend;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $data['blogs'] = Blog::all();
        return view('backend.blog.index', $data);
    }

    public function create()
    {
        return view('backend.blog.form');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect('admin/blog/create')->with('error', 'Your data is not complete.')
                ->withErrors($validate->errors())
                ->withInput($input);
        } else {
            $blog = Blog::create($input);
            return redirect('admin/blog/'.$blog->id.'/images')
                ->with('info', 'Upload images for '. $blog->title);
        }
    }

    public function edit($id = 0)
    {
        $data['edit'] = TRUE;
        $data['blog'] = Blog::find($id);

        return view('backend.blog.form', $data);
    }

    public function update(Request $request, $id = 0)
    {
        $blog = Blog::find($id);

        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
        } else {
            $blog->title = $input['title'];
            $blog->description = $input['description'];

            $blog->save();

            return redirect('admin/blog')->with('info', 'Edit Successful!');
        }
    }

    public function images($id = 0)
    {
        $data['blog'] = Blog::find($id);
        $blogImages = $data['blog']->images();

        if ($blogImages->count() > 0) {
            $data['blogImages'] = $blogImages->get();
        } else {
            $data['blogImages'] = [1];
        }

        return view('backend.blog.images', $data);
    }
}
