{{-- Trusted Used Cars Section --}}
<section 
    x-data="{ activeUsedBudget: '5 Lakh' }"
    class="py-20 bg-gray-900 text-white"
>
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <h2 class="text-3xl font-bold">Trusted used cars by budget</h2>
            <div class="flex gap-2 mt-4 md:mt-0 bg-white/10 p-1 rounded-lg">
                @foreach(['5 Lakh', '10 Lakh', '20 Lakh', '30 Lakh'] as $budget)
                    <button 
                        @click="activeUsedBudget = '{{ $budget }}'"
                        :class="activeUsedBudget === '{{ $budget }}' ? 'bg-primary text-white' : 'text-gray-300 hover:text-white'"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-all"
                    >
                        ₹{{ $budget }}
                    </button>
                @endforeach
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($mostSeenCars as $index => $car)
                <x-used-car-card :car="$car" :index="$index" x-bind:budget="activeUsedBudget" />
            @endforeach
        </div>
    </div>
</section>
