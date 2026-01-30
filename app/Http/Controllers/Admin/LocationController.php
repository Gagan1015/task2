<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::ordered()->paginate(20);
        return view('admin.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('admin.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:100',
            'car_count' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? Location::max('sort_order') + 1;

        Location::create($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Location created successfully.');
    }

    public function show(Location $location)
    {
        return redirect()->route('admin.locations.edit', $location);
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'city' => 'required|string|max:100',
            'car_count' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $location->update($validated);

        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('admin.locations.index')->with('success', 'Location deleted successfully.');
    }
}
