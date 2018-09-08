<?php

namespace App\Http\Controllers\Backend;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $data['terms'] = $settings->where('name', 'terms')->first();
//        dd($data['terms']->body);
        return view('backend.settings.index', $data);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        unset($input['files']);

        $settings = Setting::all();
        $terms = $settings->where('name', 'terms');
        $update = '';

        if ($input['terms'] != $terms) {
            $update = Setting::updateOrCreate(
                ['name' => 'terms', 'body' => $input['terms']]
            );
        }

        if ($update) {
            return redirect()->back()->with('info', 'Update Success');
        } else {
            return redirect()->back()->with('error', 'Update Failed');
        }
    }
}
