@extends('admin.layouts.app')

@section('title', 'Hero Slides')
@section('page-title', 'Hero Slides')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Hero Slides</h2>
            <p class="text-sm text-gray-500 mt-1">Create and manage homepage banner slides</p>
        </div>
        <a href="{{ route('admin.hero-slides.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Slide
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Background</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tag</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($slides as $slide)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="w-20 h-12 bg-gray-100 rounded-lg overflow-hidden">
                                    @if ($slide->background_image)
                                        <img src="{{ Storage::url($slide->background_image) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $slide->title }}</p>
                                <p class="text-sm text-gray-500 truncate max-w-xs">{{ $slide->subtitle }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($slide->tag)
                                    <span class="px-2 py-1 text-xs font-medium bg-primary/10 text-primary rounded-full">{{ $slide->tag }}</span>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-gray-600">{{ $slide->sort_order }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $slide->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $slide->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="p-2 text-gray-400 hover:text-primary rounded-lg hover:bg-gray-100" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this slide?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p>No hero slides found.</p>
                                <a href="{{ route('admin.hero-slides.create') }}" class="text-primary hover:underline mt-2 inline-block">Create your first slide</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if ($slides->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $slides->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
