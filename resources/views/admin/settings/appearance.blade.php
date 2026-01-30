@extends('admin.layouts.app')

@section('title', 'Appearance Settings')
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
            <h2 class="text-lg font-semibold text-gray-900">Appearance Settings</h2>
            <p class="text-sm text-gray-500 mt-1">Customize the look and feel of your site</p>
        </div>

        <form action="{{ route('admin.settings.appearance.update') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-2">Primary Color</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="primary_color_picker" value="{{ $settings['primary_color'] ?? '#F97316' }}" class="w-12 h-10 rounded border cursor-pointer" onchange="document.getElementById('primary_color').value = this.value">
                        <input type="text" id="primary_color" name="primary_color" value="{{ $settings['primary_color'] ?? '#F97316' }}" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none font-mono">
                    </div>
                </div>
                <div>
                    <label for="secondary_color" class="block text-sm font-medium text-gray-700 mb-2">Secondary Color</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="secondary_color_picker" value="{{ $settings['secondary_color'] ?? '#1F2937' }}" class="w-12 h-10 rounded border cursor-pointer" onchange="document.getElementById('secondary_color').value = this.value">
                        <input type="text" id="secondary_color" name="secondary_color" value="{{ $settings['secondary_color'] ?? '#1F2937' }}" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none font-mono">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="header_style" class="block text-sm font-medium text-gray-700 mb-2">Header Style</label>
                    <select id="header_style" name="header_style" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none">
                        <option value="light" {{ ($settings['header_style'] ?? 'light') === 'light' ? 'selected' : '' }}>Light</option>
                        <option value="dark" {{ ($settings['header_style'] ?? '') === 'dark' ? 'selected' : '' }}>Dark</option>
                    </select>
                </div>
                <div>
                    <label for="footer_style" class="block text-sm font-medium text-gray-700 mb-2">Footer Style</label>
                    <select id="footer_style" name="footer_style" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary outline-none">
                        <option value="dark" {{ ($settings['footer_style'] ?? 'dark') === 'dark' ? 'selected' : '' }}>Dark</option>
                        <option value="light" {{ ($settings['footer_style'] ?? '') === 'light' ? 'selected' : '' }}>Light</option>
                    </select>
                </div>
            </div>

            <!-- Preview -->
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 mb-3">Color Preview</p>
                <div class="flex items-center gap-4">
                    <div class="flex-1 h-12 rounded-lg" id="primaryPreview" style="background-color: {{ $settings['primary_color'] ?? '#F97316' }}"></div>
                    <div class="flex-1 h-12 rounded-lg" id="secondaryPreview" style="background-color: {{ $settings['secondary_color'] ?? '#1F2937' }}"></div>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('primary_color').addEventListener('input', function() {
    document.getElementById('primaryPreview').style.backgroundColor = this.value;
    document.getElementById('primary_color_picker').value = this.value;
});
document.getElementById('secondary_color').addEventListener('input', function() {
    document.getElementById('secondaryPreview').style.backgroundColor = this.value;
    document.getElementById('secondary_color_picker').value = this.value;
});
</script>
@endsection
