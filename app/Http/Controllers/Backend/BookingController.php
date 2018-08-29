<?php

namespace App\Http\Controllers\Backend;

use App\Booking;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $data['bookings'] = Booking::orderBy('created_at', 'desc')->get();
        return view('backend.booking.index', $data);
    }
}
