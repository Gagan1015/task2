{{-- News Section --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <x-section-header title="News to help choose your car" link-text="View All Posts" />
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($news as $article)
                <x-news-card :article="$article" />
            @endforeach
        </div>
    </div>
</section>
