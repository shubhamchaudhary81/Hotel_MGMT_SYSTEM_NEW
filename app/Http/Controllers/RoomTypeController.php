<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $roomTypes = RoomType::when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function create()
    {
        return view('admin.room-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:50|unique:room_types,name',
            'description' => 'nullable|string',
        ]);

        RoomType::create($request->only('name', 'description'));

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type added successfully');
    }

    public function edit(RoomType $roomType)
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    public function update(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name'        => 'required|string|max:50|unique:room_types,name,' . $roomType->id,
            'description' => 'nullable|string',
        ]);

        $roomType->update($request->only('name', 'description'));

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type updated successfully');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();

        return redirect()
            ->route('admin.room-types.index')
            ->with('success', 'Room type deleted successfully');
    }
}
