<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::ordered()->paginate(12);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
            'logo_text' => 'nullable|string|max:10',
            'website_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('brands', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? Brand::max('sort_order') + 1;

        Brand::create($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return redirect()->route('admin.brands.edit', $brand);
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:1024',
            'logo_text' => 'nullable|string|max:10',
            'website_url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($brand->logo) Storage::disk('public')->delete($brand->logo);
            $validated['logo'] = $request->file('logo')->store('brands', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $brand->update($validated);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        if ($brand->logo) Storage::disk('public')->delete($brand->logo);
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $position => $id) {
            Brand::where('id', $id)->update(['sort_order' => $position]);
        }
        return response()->json(['success' => true]);
    }
}
