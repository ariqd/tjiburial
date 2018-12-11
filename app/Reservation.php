<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
//    protected $fillable = [
//        'room_id', 'user_id', 'check_in', 'duration', 'check_out', 'room_count', 'guest_count', 'total', 'status'
//    ];

    protected $guarded = ['id'];

//    public function room()
//    {
//        return $this->belongsTo('App\Room');
//    }

    public function room()
    {
        return $this->belongsTo('App\Bedroom');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function booking()
    {
        return $this->hasOne('App\Booking');
    }

    public static function insertToJava($input, $tipe_kamar, $booking)
    {
        $reservasi = DB::connection('mysql_hotelpro2')
            ->table('reservasi')->insert([
                'idreservasi' => $input['id'],
                'idstaf' => 0,
                'idtamu' => $input['user_id'],
                'checkin' => $input['check_in'],
                'checkout' => $input['check_out'],
                'durasi' => $input['duration'],
                'jumlahkmr' => $input['room_count'],
                'subtotal' => $input['total'],
                'bookingstatus' => $input['status']
            ]);

        $room = DB::connection('mysql_hotelpro2')
            ->table('kamar_dipesan')->insert([
                'id_reservasi' => $input['id'],
                'tipekamar' => $tipe_kamar,
                'no_kamar' => '',
                'harga' => 0,
                'idtamu' => $input['user_id'],
                'status' => ''
            ]);

        $id = DB::connection('mysql_hotelpro2')
            ->table('tamu')->insertGetId([
                'idtamu' => $input['user_id'],
                'idstaf' => '',
                'nik' => '',
                'adults' => $input['guest_count'],
                'child' => $input['child'],
                'nama' => $booking['name'],
                'notelp' => $booking['phone_code'] + $booking['phone_no'],
                'alamat' => $booking['address'],
                'kota' => $booking['city'],
                'email' => $booking['email'],
                'country' => $booking['country'],
                'state' => $booking['state'],
                'dob' => $booking['dob']
            ]);

        if ($reservasi && $room && $id) {
            return $id;
        }

        return false;

    }
}
