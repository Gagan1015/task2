@props([
    'title',
    'linkText' => 'View All',
    'linkHref' => '#',
    'centered' => false
])

<div class="flex flex-col md:flex-row items-end md:items-center justify-between mb-8 {{ $centered ? 'text-center' : '' }}">
    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 relative {{ $centered ? 'mx-auto' : '' }}">
        {{ $title }}
        @unless($centered)
            <span class="absolute -bottom-2 left-0 w-12 h-1 bg-primary rounded-full"></span>
        @endunless
    </h2>
    
    @if($linkText && !$centered)
        <a 
            href="{{ $linkHref }}" 
            class="group flex items-center text-sm font-semibold text-primary hover:text-primary-dark mt-4 md:mt-0 transition-colors"
        >
            {{ $linkText }}
            <span class="ml-1 bg-primary/10 p-1 rounded-full group-hover:bg-primary group-hover:text-white transition-all">
                <x-icons.arrow-right class="w-3.5 h-3.5" />
            </span>
        </a>
    @endif
</div>
