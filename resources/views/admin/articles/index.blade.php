@extends('admin.layouts.app')

@section('title', 'Articles')
@section('page-title', 'Articles')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Articles</h2>
            <p class="text-sm text-gray-500 mt-1">Create and manage news articles</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Article
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary outline-none" placeholder="Search articles...">
            </div>
            <select name="category" class="px-4 py-2 rounded-lg border border-gray-300 focus:border-primary outline-none">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if ($articles->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach ($articles as $article)
                    <div class="p-4 flex items-start gap-4 hover:bg-gray-50">
                        <div class="w-24 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                            @if ($article->image)
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-medium text-gray-900 truncate">{{ $article->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-1 mt-1">{{ $article->excerpt }}</p>
                            <div class="flex items-center gap-3 mt-2">
                                @if($article->category)
                                    <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $article->category }}</span>
                                @endif
                                <span class="text-xs text-gray-400">{{ $article->created_at->format('M d, Y') }}</span>
                                <span class="text-xs text-gray-400">{{ $article->views }} views</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $article->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $article->is_active ? 'Published' : 'Draft' }}
                            </span>
                            <a href="{{ route('admin.articles.edit', $article) }}" class="p-2 text-gray-400 hover:text-primary rounded-lg hover:bg-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($articles->hasPages())
                <div class="px-4 py-4 border-t border-gray-100">{{ $articles->links() }}</div>
            @endif
        @else
            <div class="p-12 text-center text-gray-500">
                <p>No articles found.</p>
                <a href="{{ route('admin.articles.create') }}" class="text-primary hover:underline mt-2 inline-block">Write your first article</a>
            </div>
        @endif
    </div>
</div>
@endsection
