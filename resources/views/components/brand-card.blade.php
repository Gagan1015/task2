@props(['brand'])

<div class="flex flex-col items-center justify-center gap-4 group cursor-pointer">
    <div class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center shadow-sm group-hover:shadow-md group-hover:bg-white transition-all border border-gray-100 overflow-hidden">
        @php
            $logo = $brand['logo'] ?? '';
            $isImage = str_starts_with($logo, 'http') || str_starts_with($logo, '/storage') || str_starts_with($logo, 'brands/');
        @endphp
        
        @if($isImage)
            <img 
                src="{{ str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo) }}" 
                alt="{{ $brand['name'] }}" 
                class="w-16 h-16 object-contain group-hover:scale-110 transition-transform"
            >
        @else
            <span class="text-2xl font-black text-gray-400 group-hover:text-primary transition-colors">
                {{ strlen($logo) <= 3 ? $logo : strtoupper(substr($brand['name'], 0, 1)) }}
            </span>
        @endif
    </div>
    <span class="font-medium text-gray-600 group-hover:text-gray-900 transition-colors">
        {{ $brand['name'] }}
    </span>
</div>
