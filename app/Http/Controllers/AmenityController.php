<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function index(Request $request)
    {
        $amenities = Amenity::when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>
                ['required','string','max:100','unique:amenities,name','regex:/^[A-Za-z\s]+$/'],
            'description' => 'nullable|string'
        ],
        [
            'name.regex' => 'Only letters and spaces are allowed.'
        ]);

        Amenity::create($request->only('name','description'));

        return redirect()
            ->route('admin.amenities.index')
            ->with('success','Amenity added successfully');
    }

    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity)
    {
        $request->validate([
            'name' =>
                ['required','string','max:100','unique:amenities,name,'.$amenity->id,'regex:/^[A-Za-z\s]+$/'],
            'description' => 'nullable|string'
        ],
        [
            'name.regex' => 'Only letters and spaces are allowed.'
        ]);

        $amenity->update($request->only('name','description'));

        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenity updated successfully');
    }

    public function destroy(Amenity $amenity)
    {
        $amenity->delete();

        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenity deleted successfully');
    }
}
