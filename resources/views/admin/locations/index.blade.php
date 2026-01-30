@extends('admin.layouts.app')

@section('title', 'Locations')
@section('page-title', 'Locations')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Locations</h2>
            <p class="text-sm text-gray-500 mt-1">Manage cities and car counts</p>
        </div>
        <a href="{{ route('admin.locations.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Location
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">City</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Car Count</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Featured</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($locations as $location)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $location->city }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ number_format($location->car_count) }} cars</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $location->is_featured ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $location->is_featured ? 'Featured' : 'Regular' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $location->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $location->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.locations.edit', $location) }}" class="p-2 text-gray-400 hover:text-primary rounded-lg hover:bg-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">No locations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($locations->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">{{ $locations->links() }}</div>
        @endif
    </div>
</div>
@endsection
