<?php

namespace App\Http\Controllers\Frontend;

use App\Booking;
use App\Reservation;
use App\Room;
use App\Veritrans\Midtrans;
use App\Veritrans\Veritrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function __construct()
    {
        Veritrans::$serverKey = '';
        Veritrans::$isProduction = false;
    }

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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postal' => 'required',
            'dob.day' => 'required',
            'dob.month' => 'required',
            'dob.year' => 'required',
            'phone_code' => 'required',
            'phone_no' => 'required|numeric|digits_between:5,14',
        ]);

        $validate->setAttributeNames([
            'title' => 'Mr. / Mrs. / Ms.',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
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
            'postal' => 'Postal Code',
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
//        dd($data);
        return view('frontend.book.payment', $data);
    }

    public function token($token_id)
    {
        $items = [];
        $reservation = session('reservation');
        $booking = session('booking');
        $gross_amount = $reservation['total'] * $reservation['room_count'];
        $room = Room::find($reservation['room_id']);

        // Start Midtrans payment
//        error_log('Masuk ke snap token dri ajax');
//        $midtrans = new Midtrans;

        $transaction_details = array(
            'order_id'      => uniqid(),
            'gross_amount'  => $gross_amount
        );

        $items = [
            'id'            => $room->slug,
            'price'         => $reservation['total'],
            'quantity'      => $reservation['room_count'],
            'name'          => $room->name
        ];
//
//        $billing_address = [
//            'first_name'    => $booking['first_name'],
//            'last_name'     => $booking['last_name'],
//            'address'       => $booking['address'],
//            'city'          => $booking['city'],
//            'postal_code'   => $booking['postal'],
//            'phone'         => $booking['phone_code'].$booking['phone_no'],
//        ];
//
//        $shipping_address = [
//            'first_name'    => $booking['first_name'],
//            'last_name'     => $booking['last_name'],
//            'address'       => $booking['address'],
//            'city'          => $booking['city'],
//            'postal_code'   => $booking['postal'],
//            'phone'         => $booking['phone_code'].$booking['phone_no'],
//        ];
//
//        $customer_details = array(
//            'first_name'      => $booking['first_name'],
//            'last_name'       => $booking['last_name'],
//            'email'           => $booking['email'],
//            'phone'           => $booking['phone_code'].$booking['phone_no'],
//            'billing_address' => $billing_address,
//            'shipping_address'=> $shipping_address
//        );

        // Data yang akan dikirim untuk request redirect_url.
//        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit'       => 'hour',
            'duration'   => 2
        );

        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $items,
//            'customer_details'   => $customer_details,
//            'credit_card'        => $credit_card,
            'payment_type' => 'credit_card',
            'credit_card'  => array(
                'token_id'      => $token_id,
                'bank'          => 'bni',
//                'save_token_id' => isset($_POST['save_cc'])
            ),
            'expiry'             => $custom_expiry
        );

        $vt = new Veritrans;
        $response = $vt->vtdirect_charge($transaction_data);

        // Success
        if($response->transaction_status == 'capture') {
            echo "<p>Transaksi berhasil.</p>";
            echo "<p>Status transaksi untuk order id $response->order_id: " .
                "$response->transaction_status</p>";

            echo "<h3>Detail transaksi:</h3>";
            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

        // Deny
        else if($response->transaction_status == 'deny') {
            echo "<p>Transaksi ditolak.</p>";
            echo "<p>Status transaksi untuk order id .$response->order_id: " .
                "$response->transaction_status</p>";

            echo "<h3>Detail transaksi:</h3>";
            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

        // Challenge
        else if($response->transaction_status == 'challenge') {
            echo "<p>Transaksi challenge.</p>";
            echo "<p>Status transaksi untuk order id $response->order_id: " .
                "$response->transaction_status</p>";

            echo "<h3>Detail transaksi:</h3>";
            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

        // Error
        else {
            echo "<p>Terjadi kesalahan pada data transaksi yang dikirim.</p>";
            echo "<p>Status message: [$response->status_code] " .
                "$response->status_message</p>";

            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

//        try
//        {
//            $snap_token = $midtrans->getSnapToken($transaction_data);
//            //return redirect($vtweb_url);
//            echo $snap_token;
//        }
//        catch (Exception $e)
//        {
//            return $e->getMessage;
//        }
    }
}
