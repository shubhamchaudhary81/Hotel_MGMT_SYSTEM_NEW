<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Amenity;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST ROOMS
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $rooms = Room::with('roomType')
            ->when($request->search, function ($q) use ($request) {
                $q->where('room_number', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        $roomTypes = RoomType::all();

        return view('admin.rooms.index', compact('rooms', 'roomTypes'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $roomTypes = RoomType::all();
        $amenities = Amenity::all();

        return view('admin.rooms.create', compact('roomTypes', 'amenities'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE ROOM + AMENITIES
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|string|max:20|unique:rooms,room_number',
            'room_type_id' => 'required|exists:room_types,id',
            'base_price' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'seasonal_price' => 'nullable|numeric|min:0',
            'capacity' => 'required|integer|min:1|max:20',
            'floor_number' => 'required|integer|min:0|max:100',
            'status' => 'required|in:available,occupied,out_of_order',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // amenities validation
            'amenities' => 'nullable|array',
            'amenities.*' => 'integer|min:1',
        ]);

        $data = $request->all();

        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOAD
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {
            $folder = public_path('images/rooms');

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $filename = time() . '-' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);

            $data['image'] = 'images/rooms/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE ROOM
        |--------------------------------------------------------------------------
        */
        $room = Room::create($data);

        /*
        |--------------------------------------------------------------------------
        | STORE AMENITIES IN PIVOT TABLE
        |--------------------------------------------------------------------------
        */
        if ($request->has('amenities')) {

            $syncData = [];

            foreach ($request->amenities as $amenityId => $qty) {
                $syncData[$amenityId] = ['quantity' => $qty ?? 1];
            }

            $room->amenities()->sync($syncData);
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room added successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE ROOM + AMENITIES
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|string|max:20|unique:rooms,room_number,' . $room->id,
            'room_type_id' => 'required|exists:room_types,id',
            'base_price' => 'required|numeric|min:0',
            'weekend_price' => 'nullable|numeric|min:0',
            'seasonal_price' => 'nullable|numeric|min:0',
            'capacity' => 'required|integer|min:1|max:20',
            'floor_number' => 'required|integer|min:0|max:100',
            'status' => 'required|in:available,occupied,out_of_order',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // amenities validation
            'amenities' => 'nullable|array',
            'amenities.*' => 'integer|min:1',
        ]);

        $data = $request->all();

        /*
        |--------------------------------------------------------------------------
        | UPDATE IMAGE
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('image')) {

            // delete old image
            if ($room->image && file_exists(public_path($room->image))) {
                unlink(public_path($room->image));
            }

            $folder = public_path('images/rooms');

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $filename = time() . '-' . uniqid() . '.' . $request->image->extension();
            $request->image->move($folder, $filename);

            $data['image'] = 'images/rooms/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ROOM
        |--------------------------------------------------------------------------
        */
        $room->update($data);

        /*
        |--------------------------------------------------------------------------
        | SYNC AMENITIES
        |--------------------------------------------------------------------------
        */
        if ($request->has('amenities')) {

            $syncData = [];

            foreach ($request->amenities as $amenityId => $qty) {
                $syncData[$amenityId] = ['quantity' => $qty ?? 1];
            }

            $room->amenities()->sync($syncData);
        } else {
            // if none selected → detach all
            $room->amenities()->detach();
        }

        return redirect()
            ->back()
            ->with('success', 'Room updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ROOM
    |--------------------------------------------------------------------------
    */
    public function destroy(Room $room)
    {
        if ($room->image && file_exists(public_path($room->image))) {
            unlink(public_path($room->image));
        }

        $room->delete();

        return redirect()
            ->back()
            ->with('success', 'Room deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS ONLY
    |--------------------------------------------------------------------------
    */
    public function updateStatus(Request $request, Room $room)
    {
        $request->validate([
            'status' => 'required|in:available,occupied,out_of_order'
        ]);

        $room->update(['status' => $request->status]);

        return redirect()
            ->back()
            ->with('success', 'Status updated successfully.');
    }
}
