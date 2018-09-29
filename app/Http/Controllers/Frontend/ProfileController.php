<?php

namespace App\Http\Controllers\Frontend;

use App\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show profile page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['user'] = Auth::user();
        return view('frontend.profile.profile', $data);
    }

    /**
     * Show all reservations
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reservations()
    {
        $data['user'] = Auth::user();
        $data['reservations'] = Reservation::where('user_id', Auth::id())->orderBy('created_at','desc')->get();
        return view('frontend.profile.reservation', $data);
    }

    /**
     * Show Reservation based on ID
     *
     * @param $id Reservation ID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReservation($id)
    {
        $data['user'] = Auth::user();
        $data['reservation'] = Reservation::find($id);
        return view('frontend.profile.reservation_detail', $data);
    }
}
