@extends('admin.layouts.app')

@section('title', 'Navigation')
@section('page-title', 'Navigation')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Manage Navigation</h2>
            <p class="text-sm text-gray-500 mt-1">Configure your site navigation menu</p>
        </div>
        <a href="{{ route('admin.nav-links.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Link
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        @if ($navLinks->count() > 0)
            <ul class="divide-y divide-gray-100" id="navList">
                @foreach ($navLinks as $link)
                    <li class="p-4 hover:bg-gray-50" data-id="{{ $link->id }}">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="cursor-move text-gray-400 hover:text-gray-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $link->label }}</p>
                                    <p class="text-sm text-gray-500">{{ $link->url }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="px-2 py-1 text-xs rounded-full {{ $link->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $link->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <a href="{{ route('admin.nav-links.edit', $link) }}" class="p-2 text-gray-400 hover:text-primary rounded-lg hover:bg-gray-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.nav-links.destroy', $link) }}" method="POST" onsubmit="return confirm('Delete this link and its children?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 rounded-lg hover:bg-gray-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        @if ($link->children->count() > 0)
                            <ul class="mt-3 ml-8 border-l-2 border-gray-100 pl-4 space-y-2">
                                @foreach ($link->children as $child)
                                    <li class="flex items-center justify-between py-2">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">{{ $child->label }}</p>
                                            <p class="text-xs text-gray-400">{{ $child->url }}</p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.nav-links.edit', $child) }}" class="p-1.5 text-gray-400 hover:text-primary">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            <form action="{{ route('admin.nav-links.destroy', $child) }}" method="POST" onsubmit="return confirm('Delete?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <div class="p-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <p>No navigation links yet.</p>
                <a href="{{ route('admin.nav-links.create') }}" class="text-primary hover:underline mt-2 inline-block">Add your first link</a>
            </div>
        @endif
    </div>
</div>
@endsection
