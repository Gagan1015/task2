@props([
    'car',
    'variant' => 'default'
])

@php
    $isUpcoming = $car['isUpcoming'] ?? false;
@endphp

<div class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col h-full hover:-translate-y-1">
    {{-- Image Container --}}
    <div class="relative h-48 overflow-hidden">
        <img 
            src="{{ $car['image'] }}" 
            alt="{{ $car['name'] }}" 
            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
            loading="lazy"
        />
        
        {{-- Electric Tag --}}
        @if(!empty($car['tag']))
            <div class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                <x-icons.zap class="w-3 h-3" /> {{ $car['tag'] }}
            </div>
        @endif
        
        {{-- Upcoming Overlay --}}
        @if($isUpcoming)
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="text-white font-semibold border border-white px-4 py-2 rounded">Notify Me</span>
            </div>
        @endif
    </div>
    
    {{-- Content --}}
    <div class="p-5 flex flex-col flex-grow">
        <div class="mb-4">
            <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition-colors">
                {{ $car['name'] }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">
                {{ $isUpcoming ? 'Expected Price:' : 'Est. EMI:' }} 
                <span class="font-semibold text-gray-700">{{ $car['price'] }}</span>
            </p>
        </div>
        
        {{-- Button --}}
        <div class="mt-auto pt-4 border-t border-gray-100">
            <button class="w-full py-2.5 rounded-lg bg-white border border-primary text-primary font-medium hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-2 group-hover:gap-3">
                {{ $isUpcoming ? 'Get Alert' : 'View Details' }}
                <x-icons.arrow-right class="w-4 h-4" />
            </button>
        </div>
    </div>
</div>
