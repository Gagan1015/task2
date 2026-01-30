{{-- Visual Stories Section --}}
<section class="py-20 container mx-auto px-4">
    <x-section-header title="Car visual stories" />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($stories as $story)
            <x-story-card :story="$story" />
        @endforeach
    </div>
</section>
