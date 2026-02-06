<?php

namespace App\Http\Controllers;

use App\Models\RoomService;
use Illuminate\Http\Request;

class RoomServiceController extends Controller
{
    public function index(Request $request)
    {
        $roomServices = RoomService::when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.room-services.index', compact('roomServices'));
    }

    public function create()
    {
        return view('admin.room-services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'regex:/^[A-Za-z\s]+$/',
                'max:100',
                'unique:room_services,name'
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'availability_status' => 'required|in:available,unavailable',
        ]);

        RoomService::create($request->all());

        return redirect()
            ->route('admin.room-services.index')
            ->with('success', 'Room service added successfully.');
    }

    public function update(Request $request, RoomService $room_service)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'regex:/^[A-Za-z\s]+$/',
                'max:100',
                'unique:room_services,name,' . $room_service->id
            ],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'availability_status' => 'required|in:available,unavailable',
        ]);

        $room_service->update($request->all());

        return redirect()
            ->route('admin.room-services.index')
            ->with('success', 'Room service updated successfully.');
    }

    public function destroy(RoomService $room_service)
    {
        $room_service->delete();

        return redirect()
            ->route('admin.room-services.index')
            ->with('success', 'Room service deleted successfully.');
    }
}
