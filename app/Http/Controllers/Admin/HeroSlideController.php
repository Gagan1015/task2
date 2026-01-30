<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use App\Traits\UploadsToCloudinary;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    use UploadsToCloudinary;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = HeroSlide::ordered()->paginate(10);
        return view('admin.hero-slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:50',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle background image upload to Cloudinary
        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $this->uploadToCloudinary($request->file('background_image'), 'hero-slides');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? HeroSlide::max('sort_order') + 1;

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroSlide $heroSlide)
    {
        return redirect()->route('admin.hero-slides.edit', $heroSlide);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:50',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle background image upload to Cloudinary
        if ($request->hasFile('background_image')) {
            // Delete old background from Cloudinary
            $this->deleteFromCloudinary($heroSlide->background_image);
            $validated['background_image'] = $this->uploadToCloudinary($request->file('background_image'), 'hero-slides');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroSlide $heroSlide)
    {
        // Delete associated background image from Cloudinary
        $this->deleteFromCloudinary($heroSlide->background_image);

        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')
            ->with('success', 'Hero slide deleted successfully.');
    }

    /**
     * Reorder slides
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:hero_slides,id',
        ]);

        foreach ($request->order as $position => $id) {
            HeroSlide::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json(['success' => true]);
    }
}

