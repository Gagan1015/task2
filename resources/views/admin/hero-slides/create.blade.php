@extends('admin.layouts.app')

@section('title', isset($heroSlide) ? 'Edit Hero Slide' : 'Add Hero Slide')
@section('page-title', isset($heroSlide) ? 'Edit Hero Slide' : 'Add Hero Slide')

@section('content')
<div class="max-w-3xl">
    
    <!-- Breadcrumb -->
    <div class="mb-6">
        <a href="{{ route('admin.hero-slides.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Hero Slides
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">{{ isset($heroSlide) ? 'Edit Slide' : 'Create New Slide' }}</h2>
            <p class="text-sm text-gray-500 mt-1">{{ isset($heroSlide) ? 'Update the banner slide' : 'Add a new banner slide to the homepage carousel' }}</p>
        </div>

        <form action="{{ isset($heroSlide) ? route('admin.hero-slides.update', $heroSlide) : route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @if(isset($heroSlide)) @method('PUT') @endif

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $heroSlide->title ?? '') }}"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none @error('title') border-red-500 @enderror"
                    placeholder="e.g., Volkswagen Tayron R-line"
                    required
                >
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input 
                    type="text" 
                    id="subtitle" 
                    name="subtitle" 
                    value="{{ old('subtitle', $heroSlide->subtitle ?? '') }}"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    placeholder="e.g., The Bigger Version Of The Tiguan!"
                >
            </div>

            <!-- Tag -->
            <div>
                <label for="tag" class="block text-sm font-medium text-gray-700 mb-2">Tag Badge</label>
                <input 
                    type="text" 
                    id="tag" 
                    name="tag" 
                    value="{{ old('tag', $heroSlide->tag ?? '') }}"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    placeholder="e.g., UNVEILED, NEW, POPULAR"
                >
            </div>

            <!-- Background Image -->
            <div>
                <label for="background_image" class="block text-sm font-medium text-gray-700 mb-2">Background Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
                    <input type="file" id="background_image" name="background_image" accept="image/*" class="hidden" onchange="previewImage(this, 'bgPreview')">
                    <label for="background_image" class="cursor-pointer">
                        <div id="bgPreview" class="{{ isset($heroSlide) && $heroSlide->background_image ? '' : 'hidden' }} mb-3">
                            <img src="{{ isset($heroSlide) && $heroSlide->background_image ? imageUrl($heroSlide->background_image) : '' }}" alt="Preview" class="w-full h-48 object-cover rounded">
                        </div>
                        <div id="bgUploadText" class="{{ isset($heroSlide) && $heroSlide->background_image ? 'hidden' : '' }}">
                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-500">Click to upload background image</p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP up to 4MB. Recommended: 1920x1080px</p>
                        </div>
                    </label>
                </div>
                @if(isset($heroSlide) && $heroSlide->background_image)
                    <p class="text-xs text-gray-500 mt-2">Upload a new image to replace the current one</p>
                @endif
            </div>

            <!-- Button Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="button_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                    <input 
                        type="text" 
                        id="button_text" 
                        name="button_text" 
                        value="{{ old('button_text', $heroSlide->button_text ?? 'Know More') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    >
                </div>
                <div>
                    <label for="button_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                    <input 
                        type="text" 
                        id="button_link" 
                        name="button_link" 
                        value="{{ old('button_link', $heroSlide->button_link ?? '#') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    >
                </div>
            </div>

            <!-- Sort Order & Active -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input 
                        type="number" 
                        id="sort_order" 
                        name="sort_order" 
                        value="{{ old('sort_order', $heroSlide->sort_order ?? 0) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                        min="0"
                    >
                </div>
                <div class="flex items-center">
                    <label class="flex items-center gap-3 cursor-pointer mt-6">
                        <input type="hidden" name="is_active" value="0">
                        <input 
                            type="checkbox" 
                            name="is_active" 
                            value="1"
                            {{ old('is_active', $heroSlide->is_active ?? true) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary"
                        >
                        <span class="text-sm font-medium text-gray-700">Active (visible on site)</span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    {{ isset($heroSlide) ? 'Update Slide' : 'Create Slide' }}
                </button>
                <a href="{{ route('admin.hero-slides.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const uploadText = document.getElementById('bgUploadText');
    
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
