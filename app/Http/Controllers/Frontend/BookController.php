<?php

namespace App\Http\Controllers\Frontend;

use App\Booking;
use App\Reservation;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        $data['rooms'] = Room::all();

        $data['duration'] = [
            '1 Night', '2 Nights', '3 Nights', '4 Nights', '5 Nights', '6 Nights', '7 Nights', '8 Nights'
        ];

        $data['guest'] = [
            '1 Guest', '2 Guests', '3 Guests', '4 Guests', '5 Guests', '6 Guests', '7 Guests', '8 Guests'
        ];

        $data['rooms_count'] = [
            '1 Room', '2 Rooms', '3 Rooms', '4 Rooms', '5 Rooms', '6 Rooms', '7 Rooms', '8 Rooms'
        ];

        $data['featured'] = $data['rooms']->where('featured', 1)->first();

        return view('frontend.book.book', $data);
    }

    public function reservation(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'check_in_date' => 'required',
            'duration' => 'required',
            'guest' => 'required',
            'rooms' => 'required',
        ]);

        $validate->setAttributeNames([
            'check_in_date' => 'Check in date',
            'duration' => 'Duration',
            'guest' => 'Guest',
            'rooms' => 'Rooms',
        ]);

        if ($validate->fails()) {
            return redirect('/book')->with('error', 'Your data is not complete.')
                ->withErrors($validate->errors())->withInput($input);
        } else {

            // Count subtotal based on weekday / weekend date and duration
            $room = Room::find($input['room_id']);
            $check_in_date = Carbon::createFromFormat('Y-m-d', $input['check_in_date']);
            $duration = $input['duration'];
            $subtotal = 0;
            $pricing = [];
            for ($i = 1; $i <= $duration; $i++) {
                if ($check_in_date->isWeekend()) {
                    $subtotalNow = $subtotal + $room->price_weekend;
                    $pricing[$i]['price'] = $room->price_weekend;
                } else {
                    $subtotalNow = $subtotal + $room->price;
                    $pricing[$i]['price'] = $room->price;
                }
                $pricing[$i]['subtotal'] = $subtotal;
                $pricing[$i]['subtotalNow'] = $subtotalNow;
                $pricing[$i]['date'] = $check_in_date->format('l, F jS Y');

                $subtotal = $subtotalNow;
                $check_in_date->addDay();
                $input['check_out'] = $check_in_date->format('Y-m-d');
            }
            $input['total'] = $subtotal;
            $input['pricing'] = $pricing;
            $input['check_in'] = $input['check_in_date'];
            $input['guest_count'] = $input['guest'];
            $input['room_count'] = $input['rooms'];
            unset($input['check_in_date']);
            unset($input['guest']);
            unset($input['rooms']);

            $request->session()->put('reservation', $input);

            return redirect('/book/book-now');
        }
    }

    public function book($slug = '')
    {
        $data['reservation'] = session('reservation');
        $data['room'] = Room::find($data['reservation']['room_id']);

        $countryJson = public_path() . "/assets/json/country_code.json";
        $data['countries'] = json_decode(file_get_contents($countryJson), true);

        $data['month'] = ['', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'November', 'December'];

//        dd($data);

        return view('frontend.book.form', $data);
    }

    public function booking(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

//        $reservation = session('reservation');
//        unset($reservation['pricing']);
//        dd($reservation);

        $validate = Validator::make($input, [
            'title' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'dob.day' => 'required',
            'dob.month' => 'required',
            'dob.year' => 'required',
            'phone_code' => 'required',
            'phone_no' => 'required|numeric|digits_between:9,14',
        ]);

        $validate->setAttributeNames([
            'title' => 'Mr. / Mrs. / Ms.',
            'name' => 'Name',
            'country' => 'Country',
            'state' => 'State / Province',
            'city' => 'City',
            'address' => 'Address',
            'dob.day' => 'Birth Day',
            'dob.month' => 'Birth Month',
            'dob.year' => 'Birth Year',
            'phone_code' => 'Phone Code Number',
            'phone_no' => 'Phone Number',
            'email' => 'Email',
        ]);

        if($validate->fails()){// if validation fail
            return redirect('book/book-now')->with('error', 'Your data is not complete.')
                ->withErrors($validate->errors())->withInput($input);
        }else{
            $input['dob'] = Carbon::create($input['dob']['year'], $input['dob']['month'], $input['dob']['day']);
//            unset($input['dob']['year'])
//            dd($input);
            $request->session()->put('booking', $input);
//            $reservation['user_id'] = Auth::id();
//            $reservation['status'] = 0;
//
//            $reservation_new = Reservation::create($reservation);
//
//            $input['reservation_id'] = $reservation_new->id;
//
//            $booking = Booking::create($input);

            return redirect('/book/payment');
        }
    }

    public function payment()
    {
        $data['reservation'] = session('reservation');
        $data['booking'] = session('booking');
//        dd($data);
        $data['room'] = Room::find($data['reservation']['room_id']);
        return view('frontend.book.payment', $data);
    }
}
