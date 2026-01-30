<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::query();

        // Filter by listing type
        if ($request->filled('type')) {
            $query->where('listing_type', $request->type);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $cars = $query->ordered()->paginate(12)->withQueryString();
        
        $listingTypes = ['most_seen' => 'Most Seen', 'electric' => 'Electric', 'upcoming' => 'Upcoming', 'used' => 'Used'];
        $categories = ['suv' => 'SUV', 'sedan' => 'Sedan', 'hatchback' => 'Hatchback', 'electric' => 'Electric', 'luxury' => 'Luxury'];

        return view('admin.cars.index', compact('cars', 'listingTypes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listingTypes = ['most_seen' => 'Most Seen', 'electric' => 'Electric', 'upcoming' => 'Upcoming', 'used' => 'Used'];
        $categories = ['suv' => 'SUV', 'sedan' => 'Sedan', 'hatchback' => 'Hatchback', 'electric' => 'Electric', 'luxury' => 'Luxury'];

        return view('admin.cars.create', compact('listingTypes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'required|in:suv,sedan,hatchback,electric,luxury',
            'tag' => 'nullable|string|max:50',
            'is_upcoming' => 'boolean',
            'is_featured' => 'boolean',
            'listing_type' => 'required|in:most_seen,electric,upcoming,used',
            'year' => 'nullable|integer|min:1900|max:2030',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $validated['is_upcoming'] = $request->boolean('is_upcoming');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? Car::max('sort_order') + 1;

        Car::create($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return redirect()->route('admin.cars.edit', $car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $listingTypes = ['most_seen' => 'Most Seen', 'electric' => 'Electric', 'upcoming' => 'Upcoming', 'used' => 'Used'];
        $categories = ['suv' => 'SUV', 'sedan' => 'Sedan', 'hatchback' => 'Hatchback', 'electric' => 'Electric', 'luxury' => 'Luxury'];

        return view('admin.cars.edit', compact('car', 'listingTypes', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'required|in:suv,sedan,hatchback,electric,luxury',
            'tag' => 'nullable|string|max:50',
            'is_upcoming' => 'boolean',
            'is_featured' => 'boolean',
            'listing_type' => 'required|in:most_seen,electric,upcoming,used',
            'year' => 'nullable|integer|min:1900|max:2030',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $validated['image'] = $request->file('image')->store('cars', 'public');
        }

        $validated['is_upcoming'] = $request->boolean('is_upcoming');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $car->update($validated);

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car deleted successfully.');
    }

    /**
     * Reorder cars
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:cars,id',
        ]);

        foreach ($request->order as $position => $id) {
            Car::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json(['success' => true]);
    }
}
