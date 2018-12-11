<?php

namespace App\Http\Controllers\Frontend;

use App\Banner;
use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['duration'] = [
            '1 Night', '2 Nights', '3 Nights', '4 Nights', '5 Nights', '6 Nights', '7 Nights', '8 Nights'
        ];

        $data['guest'] = [
            '1 Guest', '2 Guests', '3 Guests', '4 Guests', '5 Guests', '6 Guests', '7 Guests', '8 Guests'
        ];

        $data['rooms_count'] = [
            '1 Room', '2 Rooms', '3 Rooms', '4 Rooms', '5 Rooms', '6 Rooms', '7 Rooms', '8 Rooms'
        ];

        $data['promotions'] = Promotion::where('status', true)->get();

        $data['banners'] = Banner::where('status', 1)->orderBy('order')->get();

//        dd($data['banners']);
        return view('frontend.index', $data);
    }
}
