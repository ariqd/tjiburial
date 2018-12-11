<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    protected $fillable = [
        'reservation_id', 'title', 'name', 'email', 'dob', 'nationality', 'country', 'state', 'city', 'address',
        'phone_code', 'phone_no'
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

//    public static function insertToJava($input, $id)
//    {
//        $booking = DB::connection('mysql_hotelpro2')
//            ->table('tamu')
//            ->where('idtamu', $id)
//            ->update([
//                'nama' => $input['name'],
//                'notelp' => $input['phone_code'] + $input['phone_no'],
//                'alamat' => $input['address'],
//                'kota' => $input['city'],
//                'email' => $input['email'],
//                'country' => $input['country'],
//                'state' => $input['state'],
//                'adults' => $input['guest_count'],
//                'child' => $input['child'],
//                'dob' => $input['dob']
//            ]);
//    }
}
