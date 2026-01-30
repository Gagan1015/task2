{{-- Electric Cars Section --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <x-section-header title="Electric cars" link-text="View All EVs" />
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($electricCars as $car)
                <x-car-card :car="$car" />
            @endforeach
        </div>
    </div>
</section>
