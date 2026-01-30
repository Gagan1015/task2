@extends('admin.layouts.app')

@section('title', 'Stories')
@section('page-title', 'Visual Stories')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Stories</h2>
            <p class="text-sm text-gray-500 mt-1">Create and manage visual stories</p>
        </div>
        <a href="{{ route('admin.stories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Story
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if ($stories->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 p-4">
                @foreach ($stories as $story)
                    <div class="relative rounded-xl overflow-hidden group aspect-[3/4]">
                        <img src="{{ Storage::url($story->image) }}" alt="{{ $story->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <p class="text-white text-sm font-medium line-clamp-2">{{ $story->title }}</p>
                            @if($story->published_date)
                                <p class="text-white/70 text-xs mt-1">{{ $story->published_date->format('M d, Y') }}</p>
                            @endif
                        </div>
                        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                            <a href="{{ route('admin.stories.edit', $story) }}" class="p-1.5 bg-white rounded-full text-gray-600 hover:text-primary">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.stories.destroy', $story) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 bg-white rounded-full text-gray-600 hover:text-red-500">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                        @if(!$story->is_active)
                            <div class="absolute top-2 left-2">
                                <span class="px-2 py-0.5 bg-gray-800/80 text-white text-xs rounded-full">Inactive</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            @if ($stories->hasPages())
                <div class="px-4 py-4 border-t border-gray-100">{{ $stories->links() }}</div>
            @endif
        @else
            <div class="p-12 text-center text-gray-500">
                <p>No stories found.</p>
                <a href="{{ route('admin.stories.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first story</a>
            </div>
        @endif
    </div>
</div>
@endsection
