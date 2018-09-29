<?php

namespace App\Http\Controllers\Frontend;

use App\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $data['faqs'] = Faq::orderBy('order')->get();
        return view('frontend.faq', $data);
    }
}
