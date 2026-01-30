{{-- Nearby Locations Section --}}
<section class="py-20 container mx-auto px-4 overflow-hidden">
    <div class="flex flex-col lg:flex-row gap-12 items-center">
        
        {{-- Left Side: Locations --}}
        <div class="lg:w-1/2">
            <h2 class="text-3xl font-bold mb-8">
                Get trusted used cars <span class="text-primary">nearby</span>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($locations as $location)
                    <x-location-card :location="$location" />
                @endforeach
            </div>
        </div>
        
        {{-- Right Side: Car Image --}}
        <div class="lg:w-1/2 flex items-center justify-center">
            <div class="relative">
                {{-- Car Image --}}
                <img 
                    src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=800&auto=format&fit=crop" 
                    alt="Find Cars Near You" 
                    class="w-full max-w-lg rounded-2xl shadow-2xl"
                >
                
                {{-- Badge --}}
                <div class="absolute -bottom-4 -right-4 bg-primary text-white px-6 py-3 rounded-xl shadow-lg">
                    <p class="text-2xl font-bold">50,000+</p>
                    <p class="text-sm opacity-90">Cars Available</p>
                </div>
            </div>
        </div>
    </div>
</section>
