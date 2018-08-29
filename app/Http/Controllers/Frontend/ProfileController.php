<?php

namespace App\Http\Controllers\Frontend;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $data['user'] = Auth::user();
        return view('frontend.profile.profile', $data);
    }

    public function reservations()
    {
        $data['user'] = Auth::user();
        $data['reservations'] = Reservation::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('frontend.profile.reservation', $data);
    }
}
