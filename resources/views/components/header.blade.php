@props(['navLinks' => [
    ['name' => 'NEW CARS', 'href' => '#'],
    ['name' => 'USED CARS', 'href' => '#'],
    ['name' => 'NEWS & REVIEWS', 'href' => '#'],
    ['name' => 'VIDEOS', 'href' => '#'],
]])

<header 
    x-data="{ 
        isScrolled: false, 
        mobileMenuOpen: false 
    }" 
    x-init="window.addEventListener('scroll', () => isScrolled = window.scrollY > 20)"
    :class="isScrolled ? 'shadow-md' : 'shadow-sm'"
    class="fixed top-0 left-0 right-0 z-50 bg-white transition-all duration-300"
>
    <div class="container mx-auto px-4 lg:px-6">
        
        {{-- Top Row: Logo, Search, User Actions --}}
        <div class="flex items-center justify-between py-3 md:py-4 gap-4">
            
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 cursor-pointer flex-shrink-0">
                <div class="bg-primary text-white p-1.5 rounded-full">
                    <x-icons.car class="w-6 h-6" fill="currentColor" stroke="currentColor" />
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-xl font-bold tracking-tight text-secondary">CarDekho</span>
                    <span class="text-[10px] text-gray-500 font-medium tracking-wide">BADHTE INDIA KA BHAROSA</span>
                </div>
            </a>

            {{-- Search Bar - Hidden on mobile --}}
            <div class="hidden md:flex flex-grow max-w-xl mx-8 relative">
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                    <x-icons.search class="w-[18px] h-[18px]" />
                </div>
                <input 
                    type="text" 
                    placeholder="Search or Ask a Question" 
                    class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary focus:ring-1 focus:ring-primary outline-none text-sm transition-all"
                />
            </div>

            {{-- Right Actions --}}
            <div class="flex items-center gap-4 lg:gap-6 text-sm font-medium text-gray-700">
                <div class="hidden lg:flex items-center gap-1 cursor-pointer hover:text-primary transition-colors">
                    <span>English</span>
                    <x-icons.chevron-down class="w-3.5 h-3.5" />
                </div>
                <div class="hidden lg:flex cursor-pointer hover:text-primary transition-colors">
                    <x-icons.heart class="w-5 h-5" />
                </div>
                <div class="hidden lg:flex items-center gap-2 cursor-pointer hover:text-primary transition-colors">
                    <x-icons.user class="w-5 h-5" />
                    <span>Login / Register</span>
                </div>
                
                {{-- Mobile Menu Toggle --}}
                <button 
                    class="lg:hidden text-gray-700" 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    <template x-if="mobileMenuOpen">
                        <x-icons.x class="w-6 h-6" />
                    </template>
                    <template x-if="!mobileMenuOpen">
                        <x-icons.menu class="w-6 h-6" />
                    </template>
                </button>
            </div>
        </div>

        {{-- Bottom Row: Navigation - Hidden on mobile --}}
        <div class="hidden lg:flex items-center justify-between border-t border-gray-100 py-3">
            <nav class="flex items-center gap-8">
                @foreach($navLinks as $link)
                    <a 
                        href="{{ $link['href'] }}" 
                        class="text-xs font-bold text-gray-700 hover:text-primary transition-colors flex items-center gap-1 group"
                    >
                        {{ $link['name'] }}
                        <x-icons.chevron-down class="w-3.5 h-3.5 text-gray-400 group-hover:text-primary transition-colors" />
                    </a>
                @endforeach
            </nav>
            
            <div class="flex items-center gap-2 text-gray-600 cursor-pointer hover:text-primary text-sm transition-colors">
                <x-icons.map-pin class="w-4 h-4" />
                <span>Select City</span>
                <x-icons.chevron-down class="w-3.5 h-3.5" />
            </div>
        </div>

    </div>

    {{-- Mobile Menu Dropdown --}}
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden absolute top-full left-0 right-0 bg-white shadow-xl border-t border-gray-100 h-screen overflow-y-auto"
    >
        <div class="p-4 space-y-4">
            <input 
                type="text" 
                placeholder="Search cars..." 
                class="w-full p-3 rounded-lg border border-gray-200 bg-gray-50 mb-4"
            />
            @foreach($navLinks as $link)
                <a href="{{ $link['href'] }}" class="block py-2 font-semibold text-gray-800 border-b border-gray-50">
                    {{ $link['name'] }}
                </a>
            @endforeach
            <div class="pt-4 flex flex-col gap-4">
                <button class="flex items-center gap-2 text-gray-700 font-medium">
                    <x-icons.map-pin class="w-[18px] h-[18px]" /> Select City
                </button>
                <button class="flex items-center gap-2 text-gray-700 font-medium">
                    <x-icons.heart class="w-[18px] h-[18px]" /> Shortlisted
                </button>
                <button class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-primary-dark transition-colors">
                    Login / Register
                </button>
            </div>
        </div>
    </div>
</header>
