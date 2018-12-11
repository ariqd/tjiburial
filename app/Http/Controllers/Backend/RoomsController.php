<?php

namespace App\Http\Controllers\Backend;

use App\Bedroom;
use App\Facility;
use App\Room;
use App\RoomPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RoomsController extends Controller
{
    public function index()
    {
//        $data['rooms'] = Bedroom::all();
        $data['rooms'] = Room::all();
        return view('backend.room.index', $data);
    }

    public function show($id = 0)
    {
        $data['room'] = Room::find($id);
        return view('backend.room.detail', $data);
    }

    public function create()
    {
        $d['facilities'] = Facility::orderBy('name')->get();
        return view('backend.room.form2', $d);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        dd($input);

        $validate = Validator::make($input, [
            'name'          => 'required',
            'type'          => 'required',
            'price'         => 'required|numeric',
            'price_weekend' => 'required|numeric',
            'overview'      => 'required',
//            'facilities'    => 'required',
            'amenities'     => 'required',
            'specials'      => 'required',
            'max_guest'     => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return redirect('admin/rooms/create')->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
        } else {
            $input['slug'] = str_slug($input['name'], '-');
            $room = Room::create($input);
            return redirect('admin/rooms/'.$room->id.'/images')->with('info', 'Upload images for '. $room->name);
        }
    }

    public function edit($id = 0)
    {
        $data['edit'] = TRUE;
        $data['room'] = Room::find($id);
        $data['facilities'] = Facility::orderBy('name')->get();

        $allotment = DB::connection('mysql_hotelpro2')
            ->select('select * from allotment where tanggal = '.date('Y-m-d'));

        dd($allotment);

        return view('backend.room.form2', $data);
    }

    public function update(Request $request, $id = 0)
    {
        $room = Room::find($id);

        $input = $request->all();
        unset($input['_token']);

        dd($input);

        $validate = Validator::make($input, [
            'name'          => 'required',
            'type'          => 'required',
            'price'         => 'required|numeric',
            'price_weekend' => 'required|numeric',
            'overview'      => 'required',
            'facilities'    => 'required',
            'amenities'     => 'required',
            'specials'      => 'required',
            'max_guest'     => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return redirect('admin/rooms/'. $id .'/edit')->with('error', 'Your data is not complete.')->withErrors($validate->errors())->withInput($input);
        } else {
            $room->update($input);

            if (!empty($input['installment'])) {
                $room->installment = $input['installment'];
            }

            if (!empty($input['featured'])) {
                $room->featured = $input['featured'];
            }

            $room->save();

            return redirect('admin/rooms')->with('info', 'Edit success for '. $room->name);
        }
    }

    public function images($id)
    {
        $data['room'] = Room::find($id);
        $roomPhotos = $data['room']->photos();

        if ($roomPhotos->count() > 0) {
            $data['roomPhotos'] = $roomPhotos->get();
        } else {
            $data['roomPhotos'] = [1];
        }

        return view('backend.room.images', $data);
    }

    public function imagesUpload(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        $room = Room::find($input['room_id']);

        $roomPhotoInput['room_id'] = $input['room_id'];

        // Delete when Remove Image button clicked
        // TODO: remove file
        if (isset($input['delete'])) {
            foreach ($input['delete'] as $value) {
                $roomDelete = RoomPhoto::find($value);
                $roomDelete->delete();
            }
        }

        if (isset($request->roomPhoto)) {
            foreach ($request->roomPhoto as $key => $roomPhoto) {
                $imageName = $room->name . '-' . date('d-m-Y') . '--'. time() . '.' . $roomPhoto['image']->getClientOriginalExtension();
                $roomPhoto['image']->storeAs('rooms/'.$room->name, $imageName, 'public_uploads');
                $roomPhotoInput['image'] = $imageName;

                // If first data in foreach then it's the Main Image
                if ($key == 0) {
                    $roomPhotoInput['main'] = 1;

                    // Code to delete old Main Image (if exist)
                    $oldMainImage = RoomPhoto::where([
                        ['room_id', $room->id],
                        ['main', 1]
                    ]);
                    if (isset($oldMainImage)) {
                        $oldMainImage->delete();
                    }
                }

                RoomPhoto::create($roomPhotoInput); // Create
            }
        }
        return redirect('admin/rooms')->with('info', 'Image Upload Success.');
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect('admin/rooms')->with('info', 'Delete Event Success.');
    }
}
