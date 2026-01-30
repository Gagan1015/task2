@props(['location'])

<div class="flex flex-col items-center justify-center p-6 bg-blue-50/50 rounded-xl hover:bg-blue-50 transition-colors cursor-pointer border border-blue-100/50">
    <div class="bg-blue-100 text-blue-600 p-3 rounded-full mb-3">
        <x-icons.map-pin class="w-5 h-5" />
    </div>
    <h4 class="font-bold text-gray-800">{{ $location['city'] }}</h4>
    <span class="text-xs text-gray-500 mt-1">{{ $location['count'] }} cars</span>
</div>
