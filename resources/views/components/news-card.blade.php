@props(['article'])

<article class="group cursor-pointer">
    <div class="rounded-xl overflow-hidden h-56 mb-5 relative">
        <img 
            src="{{ $article['image'] }}" 
            alt="{{ $article['title'] }}" 
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
            loading="lazy"
        />
        <span class="absolute top-4 left-4 bg-white text-gray-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
            {{ $article['category'] }}
        </span>
    </div>
    <h3 class="text-xl font-bold mb-3 group-hover:text-primary transition-colors line-clamp-2">
        {{ $article['title'] }}
    </h3>
    <p class="text-gray-500 text-sm mb-4 line-clamp-2">
        {{ $article['excerpt'] }}
    </p>
    <div class="flex items-center text-xs text-gray-400 gap-4">
        <span>{{ $article['date'] }}</span>
        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
        <span>{{ $article['views'] }} views</span>
    </div>
</article>
