@extends('admin.layouts.app')

@section('title', isset($navLink) ? 'Edit Link' : 'Add Link')
@section('page-title', isset($navLink) ? 'Edit Navigation Link' : 'Add Navigation Link')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('admin.nav-links.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Navigation
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">{{ isset($navLink) ? 'Edit Navigation Link' : 'Add Navigation Link' }}</h2>
        </div>

        <form action="{{ isset($navLink) ? route('admin.nav-links.update', $navLink) : route('admin.nav-links.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @if(isset($navLink)) @method('PUT') @endif

            <div>
                <label for="label" class="block text-sm font-medium text-gray-700 mb-2">Label <span class="text-red-500">*</span></label>
                <input type="text" id="label" name="label" value="{{ old('label', $navLink->label ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="e.g., Home, About Us, Contact" required>
            </div>

            <div>
                <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL <span class="text-red-500">*</span></label>
                <input type="text" id="url" name="url" value="{{ old('url', $navLink->url ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="e.g., /, /about, https://..." required>
            </div>

            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">Parent Link</label>
                <select id="parent_id" name="parent_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none">
                    <option value="">None (Top Level)</option>
                    @foreach ($parentLinks as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id', $navLink->parent_id ?? '') == $parent->id ? 'selected' : '' }}>{{ $parent->label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label for="target" class="block text-sm font-medium text-gray-700 mb-2">Open In</label>
                    <select id="target" name="target" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none">
                        <option value="_self" {{ old('target', $navLink->target ?? '_self') === '_self' ? 'selected' : '' }}>Same Window</option>
                        <option value="_blank" {{ old('target', $navLink->target ?? '') === '_blank' ? 'selected' : '' }}>New Tab</option>
                    </select>
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $navLink->sort_order ?? 0) }}" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none">
                </div>
            </div>

            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon Class (optional)</label>
                <input type="text" id="icon" name="icon" value="{{ old('icon', $navLink->icon ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none" placeholder="e.g., home, car, phone">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $navLink->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    {{ isset($navLink) ? 'Update' : 'Create' }} Link
                </button>
                <a href="{{ route('admin.nav-links.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
