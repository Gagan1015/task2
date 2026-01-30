{{-- Upcoming Cars Section --}}
<section class="py-20 container mx-auto px-4">
    <x-section-header title="Upcoming cars" link-text="View Calendar" />
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($upcomingCars as $car)
            <x-car-card :car="$car" variant="upcoming" />
        @endforeach
    </div>
</section>
