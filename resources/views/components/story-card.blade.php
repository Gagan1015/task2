@props(['story'])

<div class="relative h-80 rounded-2xl overflow-hidden cursor-pointer group">
    <img 
        src="{{ $story['image'] }}" 
        alt="{{ $story['title'] }}" 
        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
        loading="lazy"
    />
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
        <div class="absolute bottom-6 left-6 right-6">
            <span class="text-primary text-xs font-bold uppercase tracking-wider mb-2 block">
                {{ $story['date'] }}
            </span>
            <h3 class="text-white text-xl font-bold leading-tight group-hover:underline">
                {{ $story['title'] }}
            </h3>
        </div>
    </div>
</div>
