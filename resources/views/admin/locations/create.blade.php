@extends('admin.layouts.app')

@section('title', isset($location) ? 'Edit Location' : 'Add Location')
@section('page-title', isset($location) ? 'Edit Location' : 'Add Location')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('admin.locations.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Locations
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">{{ isset($location) ? 'Edit Location' : 'Add New Location' }}</h2>
        </div>

        <form action="{{ isset($location) ? route('admin.locations.update', $location) : route('admin.locations.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @if(isset($location)) @method('PUT') @endif

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City <span class="text-red-500">*</span></label>
                <input type="text" id="city" name="city" value="{{ old('city', $location->city ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
            </div>

            <div>
                <label for="car_count" class="block text-sm font-medium text-gray-700 mb-2">Car Count <span class="text-red-500">*</span></label>
                <input type="number" id="car_count" name="car_count" value="{{ old('car_count', $location->car_count ?? 0) }}" min="0" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $location->is_featured ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $location->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    {{ isset($location) ? 'Update' : 'Create' }} Location
                </button>
                <a href="{{ route('admin.locations.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
