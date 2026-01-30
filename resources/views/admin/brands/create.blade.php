@extends('admin.layouts.app')

@section('title', isset($brand) ? 'Edit Brand' : 'Add Brand')
@section('page-title', isset($brand) ? 'Edit Brand' : 'Add Brand')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <a href="{{ route('admin.brands.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Brands
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">{{ isset($brand) ? 'Edit Brand' : 'Add New Brand' }}</h2>
        </div>

        <form action="{{ isset($brand) ? route('admin.brands.update', $brand) : route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @if(isset($brand)) @method('PUT') @endif

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Brand Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $brand->name ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
            </div>

            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-300">
                @if(isset($brand) && $brand->logo)
                    <img src="{{ imageUrl($brand->logo) }}" alt="Current logo" class="w-16 h-16 object-contain mt-2">
                @endif
            </div>

            <div>
                <label for="logo_text" class="block text-sm font-medium text-gray-700 mb-2">Logo Text (fallback)</label>
                <input type="text" id="logo_text" name="logo_text" value="{{ old('logo_text', $brand->logo_text ?? '') }}" maxlength="10" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="e.g., BMW">
            </div>

            <div>
                <label for="website_url" class="block text-sm font-medium text-gray-700 mb-2">Website URL</label>
                <input type="url" id="website_url" name="website_url" value="{{ old('website_url', $brand->website_url ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="https://...">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $brand->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Active</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    {{ isset($brand) ? 'Update' : 'Create' }} Brand
                </button>
                <a href="{{ route('admin.brands.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
