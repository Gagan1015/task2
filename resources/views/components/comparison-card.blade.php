@props(['comparison'])

<div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-lg transition-shadow">
    <div class="flex justify-between items-center mb-6">
        {{-- Car A --}}
        <div class="text-center w-[45%]">
            <div class="w-full h-24 bg-gray-100 rounded mb-2 overflow-hidden">
                <img 
                    src="{{ $comparison['carA']['image'] }}" 
                    alt="{{ $comparison['carA']['name'] }}" 
                    class="w-full h-full object-cover"
                    loading="lazy"
                    onerror="this.src='https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=400'"
                />
            </div>
            <h4 class="font-bold text-sm">{{ $comparison['carA']['name'] }}</h4>
            <p class="text-xs text-gray-500">{{ $comparison['carA']['price'] }}</p>
        </div>
        
        {{-- VS Badge --}}
        <div class="bg-gray-100 rounded-full p-2 text-xs font-bold text-gray-500">VS</div>
        
        {{-- Car B --}}
        <div class="text-center w-[45%]">
            <div class="w-full h-24 bg-gray-100 rounded mb-2 overflow-hidden">
                <img 
                    src="{{ $comparison['carB']['image'] }}" 
                    alt="{{ $comparison['carB']['name'] }}" 
                    class="w-full h-full object-cover"
                    loading="lazy"
                    onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400'"
                />
            </div>
            <h4 class="font-bold text-sm">{{ $comparison['carB']['name'] }}</h4>
            <p class="text-xs text-gray-500">{{ $comparison['carB']['price'] }}</p>
        </div>
    </div>
    
    <button class="w-full py-2 border border-primary text-primary rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition-colors">
        Compare Details
    </button>
</div>
