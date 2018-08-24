<?php

namespace App\Http\Controllers\Backend;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        return view('backend.booking.index');
    }
}
