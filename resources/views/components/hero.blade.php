@props(['slides' => [
    [
        'id' => 1,
        'title' => 'Volkswagen Tayron R-line',
        'tag' => 'UNVEILED',
        'subtitle' => 'The Bigger Version Of The Tiguan!',
        'bgImage' => 'https://images.unsplash.com/photo-1533158307587-828f0a76ef93?q=80&w=2000&auto=format&fit=crop',
        'buttonText' => 'Know More',
        'buttonLink' => '#'
    ],
    [
        'id' => 2,
        'title' => 'Renault Duster Unveiled',
        'tag' => 'LATEST',
        'subtitle' => 'The Legend Returns with More Power!',
        'bgImage' => 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=2000&auto=format&fit=crop',
        'buttonText' => 'Explore',
        'buttonLink' => '#'
    ],
    [
        'id' => 3,
        'title' => 'Skoda Kushaq',
        'tag' => 'POPULAR',
        'subtitle' => 'King of the Urban Jungle',
        'bgImage' => 'https://images.unsplash.com/photo-1502877338535-766e1452684a?q=80&w=2000&auto=format&fit=crop',
        'buttonText' => 'Learn More',
        'buttonLink' => '#'
    ]
]])

<div 
    x-data="{ 
        currentSlide: 0, 
        totalSlides: {{ count($slides) }},
        activeTab: 'new',
        searchMethod: 'budget',
        init() {
            setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            }, 5000);
        }
    }"
    class="relative w-full h-[600px] lg:h-[650px] mt-[110px] md:mt-[120px] lg:mt-[135px] bg-gray-100 overflow-hidden"
>
    
    {{-- Background Image Slider --}}
    @foreach($slides as $index => $slide)
        <div 
            x-show="currentSlide === {{ $index }}"
            x-transition:enter="transition-opacity ease-out duration-1000"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0"
        >
            <img 
                src="{{ $slide['bgImage'] }}" 
                alt="Background" 
                class="w-full h-full object-cover"
                loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-black/20"></div>
        </div>
    @endforeach

    <div class="container mx-auto px-4 h-full relative flex items-center">
        
        {{-- Left Side: Search Card --}}
        <div class="relative z-20 w-full max-w-[420px] lg:ml-0 mt-8 md:mt-0">
            <div class="bg-white rounded-xl shadow-2xl p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-5">Find your right car</h2>

                {{-- Tab Switcher --}}
                <div class="flex gap-4 mb-6">
                    <button 
                        @click="activeTab = 'new'"
                        :class="activeTab === 'new' ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-600 border-gray-300 hover:border-gray-900'"
                        class="px-6 py-2 rounded text-sm font-bold border transition-colors relative"
                    >
                        New Car
                        <template x-if="activeTab === 'new'">
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[8px] border-l-transparent border-t-[8px] border-t-gray-900 border-r-[8px] border-r-transparent"></div>
                        </template>
                    </button>
                    <button 
                        @click="activeTab = 'used'"
                        :class="activeTab === 'used' ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-600 border-gray-300 hover:border-gray-900'"
                        class="px-6 py-2 rounded text-sm font-bold border transition-colors relative"
                    >
                        Used Car
                        <template x-if="activeTab === 'used'">
                            <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[8px] border-l-transparent border-t-[8px] border-t-gray-900 border-r-[8px] border-r-transparent"></div>
                        </template>
                    </button>
                </div>

                {{-- Radio Options --}}
                <div class="flex gap-6 mb-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <div 
                            :class="searchMethod === 'budget' ? 'border-primary' : 'border-gray-400'"
                            class="w-4 h-4 rounded-full border flex items-center justify-center"
                        >
                            <div x-show="searchMethod === 'budget'" class="w-2 h-2 rounded-full bg-primary"></div>
                        </div>
                        <input type="radio" name="search" class="hidden" x-model="searchMethod" value="budget" />
                        <span :class="searchMethod === 'budget' ? 'text-primary' : 'text-gray-600'" class="text-sm font-medium">By Budget</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <div 
                            :class="searchMethod === 'brand' ? 'border-primary' : 'border-gray-400'"
                            class="w-4 h-4 rounded-full border flex items-center justify-center"
                        >
                            <div x-show="searchMethod === 'brand'" class="w-2 h-2 rounded-full bg-primary"></div>
                        </div>
                        <input type="radio" name="search" class="hidden" x-model="searchMethod" value="brand" />
                        <span :class="searchMethod === 'brand' ? 'text-primary' : 'text-gray-600'" class="text-sm font-medium">By Brand</span>
                    </label>
                </div>

                {{-- Dropdowns --}}
                <div class="space-y-4 mb-6">
                    <select class="w-full p-3 bg-white border border-gray-300 rounded text-gray-700 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none cursor-pointer">
                        <option>Select Budget</option>
                        <option>1 - 5 Lakh</option>
                        <option>5 - 10 Lakh</option>
                        <option>10 - 20 Lakh</option>
                    </select>
                    <select class="w-full p-3 bg-white border border-gray-300 rounded text-gray-700 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none appearance-none cursor-pointer">
                        <option>All Vehicle Types</option>
                        <option>SUV</option>
                        <option>Sedan</option>
                        <option>Hatchback</option>
                    </select>
                </div>

                {{-- Search Button --}}
                <button class="w-full bg-primary hover:bg-primary-dark text-white font-bold py-3.5 rounded shadow-lg transition-all text-lg" style="box-shadow: 0 4px 15px rgba(255, 87, 34, 0.3);">
                    Search
                </button>

                <div class="text-right mt-3">
                    <a href="#" class="text-xs text-gray-500 hover:text-primary flex items-center justify-end gap-1 transition-colors">
                        Advanced Search <x-icons.arrow-right class="w-2.5 h-2.5" />
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Side: Content Overlay --}}
        @foreach($slides as $index => $slide)
            <div 
                x-show="currentSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-700 delay-200"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                class="absolute top-1/2 -translate-y-1/2 right-4 md:right-16 lg:right-32 text-right z-10 max-w-lg pointer-events-none hidden md:block"
            >
                @if(!empty($slide['tag']))
                <div class="bg-primary text-white text-[10px] font-bold px-3 py-1 inline-block rounded mb-3">
                    {{ $slide['tag'] }}
                </div>
                @endif
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-3 leading-tight drop-shadow-lg">
                    {{ $slide['title'] }}
                </h2>
                <p class="text-white/90 text-lg mb-6 drop-shadow-md">
                    {{ $slide['subtitle'] }}
                </p>
                
                <a href="{{ $slide['buttonLink'] ?? '#' }}" class="inline-block pointer-events-auto bg-white text-gray-900 px-8 py-3 rounded font-bold text-sm shadow-lg hover:bg-gray-100 transition-colors">
                    {{ $slide['buttonText'] ?? 'Know More' }}
                </a>
            </div>
        @endforeach

        {{-- Bottom Slider Navigation Tabs --}}
        <div class="absolute bottom-0 left-0 right-0 z-20">
            <div class="container mx-auto px-4 lg:pl-[450px]">
                <div class="flex overflow-x-auto no-scrollbar">
                    @foreach($slides as $index => $slide)
                        <button 
                            @click="currentSlide = {{ $index }}"
                            :class="currentSlide === {{ $index }} ? 'border-primary text-white bg-black/40 backdrop-blur-sm' : 'border-transparent text-white/70 hover:bg-black/20 hover:text-white'"
                            class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-4 transition-all text-left w-48"
                        >
                            {{ $slide['title'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
