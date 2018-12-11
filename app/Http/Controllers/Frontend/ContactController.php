<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\MessageNotification;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function message(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

//        dd($input);

        $validate = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect('/about')->with('error', 'Please fill all data!')
                ->withErrors($validate->errors())->withInput($input);
        } else {
            $contact = Message::create($input);
            $email = ['pondokantjiburialbdg@gmail.com', 'taniasunaryo@gmail.com'];
            Mail::to($email)->send(new MessageNotification($contact));

            return redirect('/about')->with('info', 'Message sent!');
        }
    }
}
