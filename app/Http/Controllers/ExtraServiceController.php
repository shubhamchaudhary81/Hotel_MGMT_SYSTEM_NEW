<?php

namespace App\Http\Controllers;

use App\Models\ExtraService;
use Illuminate\Http\Request;

class ExtraServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = ExtraService::when($request->search, function ($q) use ($request) {
                $q->where('service_name', 'like', "%{$request->search}%")
                  ->orWhere('price', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.extra-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.extra-services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
            'description'  => 'nullable|string|max:500',
            'price'        => 'required|numeric|min:0|max:999999',
        ], [
            'service_name.regex' => 'Only letters and spaces are allowed.',
        ]);

        ExtraService::create($request->only('service_name', 'description', 'price'));

        return redirect()
            ->route('admin.extra-services.index')
            ->with('success', 'Extra Service added successfully.');
    }

    public function update(Request $request, ExtraService $extraService)
    {
        $request->validate([
            'service_name' => ['required', 'string', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
            'description'  => 'nullable|string|max:500',
            'price'        => 'required|numeric|min:0|max:999999',
        ]);

        $extraService->update($request->only('service_name', 'description', 'price'));

        return redirect()
            ->route('admin.extra-services.index')
            ->with('success', 'Extra Service updated successfully.');
    }

    public function destroy(ExtraService $extraService)
    {
        $extraService->delete();

        return redirect()
            ->route('admin.extra-services.index')
            ->with('success', 'Extra Service deleted successfully.');
    }
}
