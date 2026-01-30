@props([
    'color' => 'orange', // 'orange' or 'blue'
    'category',
    'title',
    'description',
    'icon' => 'bar-chart' // 'bar-chart' or 'play-circle'
])

@php
    $colorClasses = [
        'orange' => [
            'bg' => 'bg-orange-100',
            'bgHover' => 'hover:bg-orange-200',
            'text' => 'text-orange-600',
            'linkText' => 'text-orange-700',
            'iconBg' => 'text-orange-500'
        ],
        'blue' => [
            'bg' => 'bg-blue-100',
            'bgHover' => 'hover:bg-blue-200',
            'text' => 'text-blue-600',
            'linkText' => 'text-blue-700',
            'iconBg' => 'text-blue-500'
        ]
    ];
    $colors = $colorClasses[$color] ?? $colorClasses['orange'];
@endphp

<div class="{{ $colors['bg'] }} rounded-2xl p-8 flex items-center justify-between group {{ $colors['bgHover'] }} transition-colors cursor-pointer">
    <div class="w-2/3">
        <span class="{{ $colors['text'] }} font-bold uppercase text-xs mb-2 block">{{ $category }}</span>
        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $title }}</h3>
        <p class="text-gray-600 text-sm mb-6">{{ $description }}</p>
        <span class="flex items-center gap-2 {{ $colors['linkText'] }} font-bold text-sm group-hover:gap-3 transition-all">
            Read Article 
            <x-icons.arrow-right class="w-4 h-4" />
        </span>
    </div>
    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center {{ $colors['iconBg'] }} shadow-xl">
        @if($icon === 'bar-chart')
            <x-icons.bar-chart class="w-10 h-10" />
        @else
            <x-icons.play-circle class="w-10 h-10" />
        @endif
    </div>
</div>
