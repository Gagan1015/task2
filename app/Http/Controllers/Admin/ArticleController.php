<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->latest()->paginate(12)->withQueryString();
        $categories = Article::distinct()->pluck('category')->filter();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return redirect()->route('admin.articles.edit', $article);
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,' . $article->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($article->image) Storage::disk('public')->delete($article->image);
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');
        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->image) Storage::disk('public')->delete($article->image);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully.');
    }
}
