{{-- Comparison Tool Section --}}
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4">
        <x-section-header title="Compare to find the right car" />
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach($comparisonCars as $comparison)
                <x-comparison-card :comparison="$comparison" />
            @endforeach
        </div>
    </div>
</section>
