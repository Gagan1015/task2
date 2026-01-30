{{-- Most Seen Cars Section --}}
<section class="py-20 container mx-auto px-4">
    <x-section-header title="The most seen cars" link-text="View All Stock" />
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($mostSeenCars as $car)
            <x-car-card :car="$car" />
        @endforeach
    </div>
</section>
