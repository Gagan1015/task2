@extends('admin.layouts.app')

@section('title', 'General Settings')
@section('page-title', 'Settings')

@section('content')
<div class="max-w-3xl">
    <!-- Settings Tabs -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm mb-6">
        <div class="flex border-b border-gray-100">
            <a href="{{ route('admin.settings.general') }}" class="px-6 py-3 text-sm font-medium border-b-2 {{ request()->routeIs('admin.settings.general') ? 'border-primary text-primary' : 'border-transparent text-gray-600 hover:text-gray-900' }}">General</a>
            <a href="{{ route('admin.settings.appearance') }}" class="px-6 py-3 text-sm font-medium border-b-2 {{ request()->routeIs('admin.settings.appearance') ? 'border-primary text-primary' : 'border-transparent text-gray-600 hover:text-gray-900' }}">Appearance</a>
            <a href="{{ route('admin.settings.social') }}" class="px-6 py-3 text-sm font-medium border-b-2 {{ request()->routeIs('admin.settings.social') ? 'border-primary text-primary' : 'border-transparent text-gray-600 hover:text-gray-900' }}">Social Links</a>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">General Settings</h2>
            <p class="text-sm text-gray-500 mt-1">Configure basic site information</p>
        </div>

        <form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                <input type="text" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? 'CarDealer' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none">
            </div>

            <div>
                <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                <input type="text" id="site_tagline" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="Your trusted automotive partner">
            </div>

            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">Site Logo</label>
                <input type="file" id="logo" name="logo" accept="image/*" class="w-full px-4 py-2.5 rounded-lg border border-gray-300">
                @if(isset($settings['site_logo']) && $settings['site_logo'])
                    <img src="{{ imageUrl($settings['site_logo']) }}" alt="Logo" class="h-12 mt-2">
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                    <input type="email" id="contact_email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="contact@cardealer.com">
                </div>
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                    <input type="text" id="contact_phone" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="+91 1800 000 0000">
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <textarea id="address" name="address" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none" placeholder="Your business address">{{ $settings['address'] ?? '' }}</textarea>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
