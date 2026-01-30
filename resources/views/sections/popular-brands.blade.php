{{-- Popular Brands Section --}}
<section class="py-16 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <x-section-header title="Popular Brands" :centered="true" />
        <div class="grid grid-cols-3 md:grid-cols-6 gap-8 mt-10">
            @foreach($brands as $brand)
                <x-brand-card :brand="$brand" />
            @endforeach
        </div>
    </div>
</section>
