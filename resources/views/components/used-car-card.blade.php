@props([
    'car',
    'budget' => '5 Lakh',
    'index' => 0
])

@php
    $price = (float)(preg_replace('/[^0-9.]/', '', $budget)) * 0.8 + $index;
@endphp

<div class="bg-white rounded-xl overflow-hidden shadow-lg group">
    <div class="relative h-40">
        <img 
            src="{{ $car['image'] }}" 
            alt="{{ $car['name'] }}" 
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            loading="lazy"
        />
    </div>
    <div class="p-4 text-gray-900">
        <h3 class="font-bold text-lg">{{ $car['name'] }} 2020</h3>
        <p class="text-primary font-bold mt-1">₹ {{ number_format($price, 2) }} Lakh</p>
        <div class="mt-3 flex justify-between items-center text-xs text-gray-500 border-t border-gray-100 pt-3">
            <span>34k km</span>
            <span>Petrol</span>
            <span>Automatic</span>
        </div>
        <button class="w-full mt-4 py-2 border border-gray-200 rounded text-sm font-semibold hover:bg-gray-50 transition-colors">
            View Details
        </button>
    </div>
</div>
