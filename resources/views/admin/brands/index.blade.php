@extends('admin.layouts.app')

@section('title', 'Brands')
@section('page-title', 'Brands')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Brands</h2>
            <p class="text-sm text-gray-500 mt-1">Create and manage car brands</p>
        </div>
        <a href="{{ route('admin.brands.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Brand
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if ($brands->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 p-4">
                @foreach ($brands as $brand)
                    <div class="border border-gray-100 rounded-xl p-4 text-center hover:shadow-lg transition-shadow group relative">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-3">
                            @if ($brand->logo)
                                <img src="{{ imageUrl($brand->logo) }}" alt="{{ $brand->name }}" class="w-12 h-12 object-contain">
                            @else
                                <span class="text-xl font-bold text-gray-600">{{ $brand->logo_text ?: substr($brand->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <p class="font-medium text-gray-900 text-sm">{{ $brand->name }}</p>
                        <span class="text-xs {{ $brand->is_active ? 'text-green-600' : 'text-gray-400' }}">
                            {{ $brand->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="p-1.5 bg-white shadow rounded-full text-gray-600 hover:text-primary">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline" onsubmit="return confirm('Delete this brand?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 bg-white shadow rounded-full text-gray-600 hover:text-red-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($brands->hasPages())
                <div class="px-4 py-4 border-t border-gray-100">{{ $brands->links() }}</div>
            @endif
        @else
            <div class="p-12 text-center text-gray-500">
                <p>No brands found.</p>
                <a href="{{ route('admin.brands.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first brand</a>
            </div>
        @endif
    </div>
</div>
@endsection
