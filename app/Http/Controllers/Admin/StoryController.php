<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Traits\UploadsToCloudinary;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    use UploadsToCloudinary;
    public function index()
    {
        $stories = Story::ordered()->paginate(12);
        return view('admin.stories.index', compact('stories'));
    }

    public function create()
    {
        return view('admin.stories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_date' => 'nullable|date',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['image'] = $this->uploadToCloudinary($request->file('image'), 'stories');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? Story::max('sort_order') + 1;

        Story::create($validated);

        return redirect()->route('admin.stories.index')->with('success', 'Story created successfully.');
    }

    public function show(Story $story)
    {
        return redirect()->route('admin.stories.edit', $story);
    }

    public function edit(Story $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    public function update(Request $request, Story $story)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'published_date' => 'nullable|date',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $this->deleteFromCloudinary($story->image);
            $validated['image'] = $this->uploadToCloudinary($request->file('image'), 'stories');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $story->update($validated);

        return redirect()->route('admin.stories.index')->with('success', 'Story updated successfully.');
    }

    public function destroy(Story $story)
    {
        $this->deleteFromCloudinary($story->image);
        $story->delete();
        return redirect()->route('admin.stories.index')->with('success', 'Story deleted successfully.');
    }
}
