@extends('admin.layouts.app')

@section('title', isset($article) ? 'Edit Article' : 'Add Article')
@section('page-title', isset($article) ? 'Edit Article' : 'Add Article')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Articles
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">{{ isset($article) ? 'Edit Article' : 'Write New Article' }}</h2>
        </div>

        <form action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @if(isset($article)) @method('PUT') @endif

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $article->title ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none" placeholder="auto-generated-from-title">
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <input type="text" id="category" name="category" value="{{ old('category', $article->category ?? '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none" placeholder="e.g., News, Reviews">
                </div>
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none" placeholder="Brief summary...">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="content" name="content" rows="10" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none font-mono text-sm">{{ old('content', $article->content ?? '') }}</textarea>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-300">
                @if(isset($article) && $article->image)
                    <img src="{{ Storage::url($article->image) }}" alt="Current" class="w-32 h-20 object-cover rounded mt-2">
                @endif
            </div>

            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
                <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $article->is_featured ?? false) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Featured</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $article->is_active ?? true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    {{ isset($article) ? 'Update' : 'Publish' }} Article
                </button>
                <a href="{{ route('admin.articles.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
