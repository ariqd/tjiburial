<?php

namespace App\Http\Controllers\Frontend;

use App\Promotion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionsController extends Controller
{
    public function show($id)
    {
        $data['promotion'] = Promotion::find($id);
        $data['images'] = $data['promotion']->images()->where('main', 0)->get();
        $data['others'] = Promotion::where('id', '!=', $id)->take(4)->get();
        return view('frontend.promotions.detail', $data);
    }
}
