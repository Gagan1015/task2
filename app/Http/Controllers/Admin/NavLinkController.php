<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavLink;
use Illuminate\Http\Request;

class NavLinkController extends Controller
{
    public function index()
    {
        $navLinks = NavLink::whereNull('parent_id')->ordered()->with('children')->get();
        return view('admin.nav-links.index', compact('navLinks'));
    }

    public function create()
    {
        $parentLinks = NavLink::whereNull('parent_id')->ordered()->get();
        return view('admin.nav-links.create', compact('parentLinks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:nav_links,id',
            'target' => 'required|in:_self,_blank',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? NavLink::max('sort_order') + 1;

        NavLink::create($validated);

        return redirect()->route('admin.nav-links.index')->with('success', 'Navigation link created successfully.');
    }

    public function show(NavLink $navLink)
    {
        return redirect()->route('admin.nav-links.edit', $navLink);
    }

    public function edit(NavLink $navLink)
    {
        $parentLinks = NavLink::whereNull('parent_id')->where('id', '!=', $navLink->id)->ordered()->get();
        return view('admin.nav-links.edit', compact('navLink', 'parentLinks'));
    }

    public function update(Request $request, NavLink $navLink)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:nav_links,id',
            'target' => 'required|in:_self,_blank',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $navLink->update($validated);

        return redirect()->route('admin.nav-links.index')->with('success', 'Navigation link updated successfully.');
    }

    public function destroy(NavLink $navLink)
    {
        // Also delete children
        $navLink->children()->delete();
        $navLink->delete();

        return redirect()->route('admin.nav-links.index')->with('success', 'Navigation link deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:nav_links,id',
        ]);

        foreach ($request->order as $position => $id) {
            NavLink::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json(['success' => true]);
    }
}
