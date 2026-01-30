@extends('admin.layouts.app')

@section('title', isset($story) ? 'Edit Story' : 'Add Story')
@section('page-title', isset($story) ? 'Edit Story' : 'Add Story')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('admin.stories.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Stories
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">{{ isset($story) ? 'Edit Story' : 'Add New Story' }}</h2>
        </div>

        <form action="{{ isset($story) ? route('admin.stories.update', $story) : route('admin.stories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @if(isset($story)) @method('PUT') @endif

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $story->title ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image {{ isset($story) ? '' : '<span class="text-red-500">*</span>' }}</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-300" {{ isset($story) ? '' : 'required' }}>
                @if(isset($story) && $story->image)
                    <img src="{{ Storage::url($story->image) }}" alt="Current" class="w-32 h-40 object-cover rounded mt-2">
                @endif
            </div>

            <div>
                <label for="published_date" class="block text-sm font-medium text-gray-700 mb-2">Published Date</label>
                <input type="date" id="published_date" name="published_date" value="{{ old('published_date', isset($story) && $story->published_date ? $story->published_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 mb-2">Link</label>
                <input type="text" id="link" name="link" value="{{ old('link', $story->link ?? '#') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $story->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    {{ isset($story) ? 'Update' : 'Create' }} Story
                </button>
                <a href="{{ route('admin.stories.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
