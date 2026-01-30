@extends('admin.layouts.app')

@section('title', 'Edit Car')
@section('page-title', 'Edit Car')

@section('content')
<div class="max-w-3xl">
    
    <!-- Breadcrumb -->
    <div class="mb-6">
        <a href="{{ route('admin.cars.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Cars
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">Edit Car</h2>
            <p class="text-sm text-gray-500 mt-1">Update car listing details</p>
        </div>

        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Name & Price -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Car Name <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $car->name) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none @error('name') border-red-500 @enderror"
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        id="price" 
                        name="price" 
                        value="{{ old('price', $car->price) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none @error('price') border-red-500 @enderror"
                        required
                    >
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Category & Listing Type -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                    <select id="category" name="category" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
                        @foreach ($categories as $key => $label)
                            <option value="{{ $key }}" {{ old('category', $car->category) === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="listing_type" class="block text-sm font-medium text-gray-700 mb-2">Listing Type <span class="text-red-500">*</span></label>
                    <select id="listing_type" name="listing_type" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
                        @foreach ($listingTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('listing_type', $car->listing_type) === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tag & Year -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-2">Tag Badge</label>
                    <input 
                        type="text" 
                        id="tag" 
                        name="tag" 
                        value="{{ old('tag', $car->tag) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    >
                </div>
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                    <input 
                        type="number" 
                        id="year" 
                        name="year" 
                        value="{{ old('year', $car->year) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                        min="1900"
                        max="2030"
                    >
                </div>
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Car Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
                    <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewImage(this, 'imagePreview')">
                    <label for="image" class="cursor-pointer">
                        <div id="imagePreview" class="{{ $car->image ? '' : 'hidden' }} mb-3">
                            <img src="{{ $car->image ? imageUrl($car->image) : '' }}" alt="Preview" class="w-full max-w-md mx-auto h-48 object-contain rounded">
                        </div>
                        <div id="imageUploadText" class="{{ $car->image ? 'hidden' : '' }}">
                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16"/></svg>
                            <p class="text-sm text-gray-500">Click to upload</p>
                        </div>
                        @if($car->image)
                            <p class="text-xs text-gray-400 mt-2">Click to replace</p>
                        @endif
                    </label>
                </div>
            </div>

            <!-- Options Row -->
            <div class="flex flex-wrap gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $car->is_featured) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_upcoming" value="0">
                    <input type="checkbox" name="is_upcoming" value="1" {{ old('is_upcoming', $car->is_upcoming) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Upcoming</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $car->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <!-- Sort Order -->
            <div class="max-w-[200px]">
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                <input 
                    type="number" 
                    id="sort_order" 
                    name="sort_order" 
                    value="{{ old('sort_order', $car->sort_order) }}"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    min="0"
                >
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    Update Car
                </button>
                <a href="{{ route('admin.cars.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const uploadText = document.getElementById('imageUploadText');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.querySelector('img').src = e.target.result;
            preview.classList.remove('hidden');
            if (uploadText) uploadText.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
