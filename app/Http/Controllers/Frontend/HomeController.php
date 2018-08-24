<?php

namespace App\Http\Controllers\Frontend;

use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['promotions'] = Promotion::all();
        return view('frontend.index', $data);
    }
}
