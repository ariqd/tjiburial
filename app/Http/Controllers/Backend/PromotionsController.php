<?php

namespace App\Http\Controllers\Backend;

use App\Promotion;
use App\PromotionImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PromotionsController extends Controller
{
    public function index()
    {
        $data['promotions'] = Promotion::all();
        return view('backend.promotions.promotions', $data);
    }

    public function create()
    {
        return view('backend.promotions.form');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect('admin/promotions/create')->with('error', 'Your data is not complete.')
                ->withErrors($validate->errors())
                ->withInput($input);
        } else {
            $promotion = Promotion::create($input);
            return redirect('admin/promotions/'.$promotion->id.'/images')
                ->with('info', 'Upload images for '. $promotion->title);
        }
    }

    public function edit($id = 0)
    {
        $data['edit'] = TRUE;
        $data['promotion'] = Promotion::find($id);

        return view('backend.promotions.form', $data);
    }

    public function update(Request $request, $id = 0)
    {
        $promotion = Promotion::find($id);

        $input = $request->all();
        unset($input['_token']);

        $validate = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
//            return redirect('admin/promotions/'. $id .'/edit')->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
        } else {
//            $promotion = Room::create($input);

            $promotion->title = $input['title'];
            $promotion->description = $input['description'];

            if (!empty($input['status'])) {
                $promotion->status = $input['status'];
            } else {
                $promotion->status = 0;
            }

            $promotion->save();

            return redirect('admin/promotions')->with('info', 'Edit Successful!');
        }
    }

    public function images($id)
    {
        $data['promotion'] = Promotion::find($id);
        $promotionImages = $data['promotion']->images();

        if ($promotionImages->count() > 0) {
            $data['promotionImages'] = $promotionImages->get();
        } else {
            $data['promotionImages'] = [1];
        }

        return view('backend.promotions.images', $data);
    }

    public function imagesUpload(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $promotion = Promotion::find($input['promotion_id']);

        $promotionImageInput['promotion_id'] = $input['promotion_id'];

        if (isset($input['delete'])) {
            foreach ($input['delete'] as $value) {
                $promotionDelete = PromotionImage::find($value);
                $promotionDelete->delete();
            }
        }

        if (isset($request->promotionImages)) {
            foreach ($request->promotionImages as $key => $promotionImage) {
                $imageName = $promotion->title . '-' . date('d-m-Y') . '--'. time() . '.' . $promotionImage['image']->getClientOriginalExtension();
                $promotionImage['image']->storeAs('promotions/'.$promotion->title, $imageName, 'public_uploads');
                $promotionImageInput['image'] = $imageName;
                $promotionImageInput['main'] = 0;
                if ($key == 0) {
                    $promotionImageInput['main'] = 1;
                    // Code to delete old Main Image (if exist)
                    $oldMainImage = PromotionImage::where([
                        ['promotion_id', $promotion->id],
                        ['main', 1]
                    ]);
                    if (isset($oldMainImage)) {
                        $oldMainImage->delete();
                    }
                }

                PromotionImage::create($promotionImageInput);
            }
        }

        return redirect('admin/promotions')->with('info', 'Image Settings Success.');
    }

    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete();

        return redirect('admin/promotions')->with('info', 'Delete Promotion Success.');
    }
}
