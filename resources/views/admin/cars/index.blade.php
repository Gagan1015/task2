@extends('admin.layouts.app')

@section('title', 'Cars')
@section('page-title', 'Cars')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Cars</h2>
            <p class="text-sm text-gray-500 mt-1">Create and manage car listings</p>
        </div>
        <a href="{{ route('admin.cars.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Car
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
        <form action="{{ route('admin.cars.index') }}" method="GET" class="flex flex-wrap gap-4">
            <!-- Search -->
            <div class="flex-1 min-w-[200px]">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none"
                    placeholder="Search cars..."
                >
            </div>
            
            <!-- Listing Type Filter -->
            <div>
                <select name="type" class="px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    <option value="">All Types</option>
                    @foreach ($listingTypes as $key => $label)
                        <option value="{{ $key }}" {{ request('type') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div>
                <select name="category" class="px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
                    <option value="">All Categories</option>
                    @foreach ($categories as $key => $label)
                        <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                Filter
            </button>
            @if (request()->hasAny(['search', 'type', 'category']))
                <a href="{{ route('admin.cars.index') }}" class="px-4 py-2 text-gray-500 hover:text-gray-700">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Cars Grid -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if ($cars->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4">
                @foreach ($cars as $car)
                    <div class="border border-gray-100 rounded-xl overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                            @if ($car->image)
                                <img src="{{ Storage::url($car->image) }}" alt="{{ $car->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9"/></svg>
                                </div>
                            @endif
                            
                            @if ($car->tag)
                                <span class="absolute top-2 left-2 px-2 py-1 text-xs font-bold bg-primary text-white rounded">{{ $car->tag }}</span>
                            @endif
                            
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                <a href="{{ route('admin.cars.edit', $car) }}" class="p-2 bg-white rounded-full text-gray-700 hover:text-primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Delete this car?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-white rounded-full text-gray-700 hover:text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 truncate">{{ $car->name }}</h3>
                            <p class="text-primary font-bold mt-1">{{ $car->price }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-600 rounded-full">{{ ucfirst($car->category) }}</span>
                                <span class="text-xs {{ $car->is_active ? 'text-green-600' : 'text-gray-400' }}">
                                    {{ $car->is_active ? '● Active' : '○ Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($cars->hasPages())
                <div class="px-4 py-4 border-t border-gray-100">
                    {{ $cars->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9"/></svg>
                <p>No cars found.</p>
                <a href="{{ route('admin.cars.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first car</a>
            </div>
        @endif
    </div>
</div>
@endsection
