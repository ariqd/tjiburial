<?php

namespace App\Http\Controllers\Frontend;

use App\Booking;
use App\Http\Controllers\SnapController;
use App\Http\Controllers\TransactionController;
use App\Reservation;
use App\Room;
use App\Veritrans\Midtrans;
use App\Veritrans\Veritrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Comparator\Book;

class BookController extends Controller
{
    public $snapController;
    public $transactionController;

    public function __construct()
    {
        $this->snapController = new SnapController();
        $this->transactionController = new TransactionController();
    }
//    public function __construct()
//    {
//        Veritrans::$serverKey = 'SB-Mid-server-F8a44BVHzPec2ql3UiiU7QvR';
//        Veritrans::$isProduction = false;
//    }

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
            'check_in_date'=> 'required',
            'duration'     => 'required',
            'guest'        => 'required',
            'rooms'        => 'required',
        ]);

        $validate->setAttributeNames([
            'check_in_date'=> 'Check in date',
            'duration'     => 'Duration',
            'guest'        => 'Guest',
            'rooms'        => 'Rooms',
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
            $input['total']      = $subtotal;
            $input['pricing']    = $pricing;
            $input['check_in']   = $input['check_in_date'];
            $input['guest_count']= $input['guest'];
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
            'title'     => 'required',
            'first_name'=> 'required',
            'last_name' => 'required',
            'email'     => 'required|email',
            'country'   => 'required',
            'state'     => 'required',
            'city'      => 'required',
            'address'   => 'required',
            'postal'    => 'required',
            'dob.day'   => 'required',
            'dob.month' => 'required',
            'dob.year'  => 'required',
            'phone_code'=> 'required',
            'phone_no'  => 'required|numeric|digits_between:5,14',
        ]);

        $validate->setAttributeNames([
            'title'     => 'Mr. / Mrs. / Ms.',
            'first_name'=> 'First Name',
            'last_name' => 'Last Name',
            'country'   => 'Country',
            'state'     => 'State / Province',
            'city'      => 'City',
            'address'   => 'Address',
            'dob.day'   => 'Birth Day',
            'dob.month' => 'Birth Month',
            'dob.year'  => 'Birth Year',
            'phone_code'=> 'Phone Code Number',
            'phone_no'  => 'Phone Number',
            'email'     => 'Email',
            'postal'    => 'Postal Code',
        ]);

        if($validate->fails()){// if validation fail
            return redirect('book/book-now')->with('error', 'Your data is not complete.')
                ->withErrors($validate->errors())->withInput($input);
        }else{
            $input['dob'] = Carbon::create($input['dob']['year'], $input['dob']['month'], $input['dob']['day']);
            $input['name'] = $input['first_name'] . ' ' . $input['last_name'];
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
        $data['room'] = Room::find($data['reservation']['room_id']);
        $data['payments'] = [
            'credit_card' => [
                'name' => 'Credit Card',
                'values' => [
                    'bca' => 'BCA',
                    'bni' => 'BNI',
                    'mandiri' => 'Mandiri',
                    'cimb' => 'CIMB',
                    'bri' => 'BRI',
                    'danamon' => 'Danamon',
                    'maybank' => 'Maybank',
                    'mega' => 'Mega'
                ],
            ],
            'others' => [
                'name' => 'Others',
                'values' => [
                    'onsite' => 'Directly at Hotel'
                ]
            ]
        ];
//        dd($data);
        return view('frontend.book.payment', $data);
    }

    public function snap()
    {
        $reservation = session('reservation');
        $data['room'] = Room::find($reservation['room_id']);
        $data['snap_token'] = session('snap_token');
        $data['payment_type'] = session('payment_type');
        return view('checkout', $data);
    }

    public function token()
    {
        $reservation = session('reservation');
        $booking = session('booking');
        $gross_amount = $reservation['total'] * $reservation['room_count'];
        $room = Room::find($reservation['room_id']);

        $transaction_details = [
            'order_id' => time(),
            'gross_amount' => $gross_amount
        ];

        $address = $booking['address'] . ', ' . $booking['city'] . ', ' . $booking['state'] . ', ' . $booking['country'];

        $customer_details = [
            'first_name'    => $booking['first_name'],
            'last_name'     => $booking['last_name'],
            'email'         => $booking['email'],
            'phone'         => $booking['phone_code'].$booking['phone_no'],
            'address'       => $address
        ];

        $custom_expiry = [
            'start_time'=> date("Y-m-d H:i:s O", time()),
            'unit'      => 'day',
            'duration'  => 2
        ];

        $item_details = [
            'id'            => $room->slug,
            'price'         => $reservation['total'],
            'quantity'      => $reservation['room_count'],
            'name'          => $room->name
        ];

        // Send this options if you use 3Ds in credit card request
        $credit_card_option = [
            'secure' => true,
            'channel' => 'migs'
        ];

        $transaction_data = [
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'expiry'             => $custom_expiry,
//                'credit_card' => $credit_card_option,
        ];

        try
        {
            $midtrans = new Midtrans;
            $snap_token = $midtrans->getSnapToken($transaction_data);
            //return redirect($vtweb_url);
            echo $snap_token;
        }
        catch (Exception $e)
        {
            return $e->getMessage;
        }
    }

    public function pay(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
//        dd($input);
        $reservation = session('reservation');
        $booking = session('booking');
        $gross_amount = $reservation['total'] * $reservation['room_count'];
        $room = Room::find($reservation['room_id']);

        unset($reservation['pricing']);
        $reservation['user_id'] = Auth::id();
        $reservation['status'] = 0;
        if ($input['payment_type'] == 'Credit Card' && $input['result_type'] == 'success') {
            $reservation['status'] = 1;
            $reservation['payment_type'] = "Credit Card";
        } else if ($input['payment_type'] == 'direct' && $input['result_type'] == 'success') {
            $reservation['status'] = 2;
            $reservation['payment_type'] = "At Check In";
        }

        unset($booking['first_name']);
        unset($booking['last_name']);

//            dd($booking);

        $reservation = Reservation::create($reservation);

        $booking['reservation_id'] = $reservation->id;

        Booking::create($booking);

        return redirect('book/finish');
    }

    public function finish()
    {
        $data['reservation'] = session('reservation');
        $data['book'] = session('book');
        $data['room'] = Room::find($data['reservation']['room_id']);
        return view('frontend.book.finish', $data);
    }
}
