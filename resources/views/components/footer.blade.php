<footer class="bg-white border-t border-gray-200 pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 mb-12">
            
            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2 mb-6">
                    <div class="bg-primary text-white p-1.5 rounded-lg">
                        <x-icons.car class="w-6 h-6" fill="currentColor" stroke="currentColor" />
                    </div>
                    <span class="text-xl font-bold text-secondary">CarDealer</span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    The most trusted marketplace to buy, sell, and rent vehicles. Award-winning service and transparent pricing.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                        <x-icons.facebook class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                        <x-icons.instagram class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                        <x-icons.twitter class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                        <x-icons.youtube class="w-5 h-5" />
                    </a>
                </div>
            </div>

            {{-- Links Column 1 --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">What's it?</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-primary transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">FAQ</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Terms of Service</a></li>
                </ul>
            </div>

            {{-- Links Column 2 --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">Car Solid</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-primary transition-colors">How it works</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Featured Listings</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Trust & Safety</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Dealer Hub</a></li>
                </ul>
            </div>

            {{-- Links Column 3 --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">Others</h4>
                <ul class="space-y-3 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-primary transition-colors">Latest Blog</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Car Reviews</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Support Center</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- App Download --}}
            <div>
                <h4 class="font-bold text-gray-900 mb-6">Get the App</h4>
                <div class="flex flex-col gap-3">
                    <a href="#" class="bg-gray-900 text-white px-4 py-2.5 rounded-lg flex items-center gap-3 hover:bg-gray-800 transition-colors">
                        {{-- Apple Icon --}}
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                        </svg>
                        <div class="text-left leading-tight">
                            <div class="text-[10px] text-gray-400">Download on the</div>
                            <div class="text-sm font-semibold">App Store</div>
                        </div>
                    </a>
                    <a href="#" class="bg-gray-900 text-white px-4 py-2.5 rounded-lg flex items-center gap-3 hover:bg-gray-800 transition-colors">
                        {{-- Google Play Icon --}}
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-3.198l2.807 1.626a1 1 0 0 1 0 1.73l-2.808 1.626L15.206 12l2.492-2.491zM5.864 2.658L16.8 9.99l-2.302 2.302-8.634-8.634z"/>
                        </svg>
                        <div class="text-left leading-tight">
                            <div class="text-[10px] text-gray-400">GET IT ON</div>
                            <div class="text-sm font-semibold">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-gray-400">© {{ date('Y') }} CarDealer. All rights reserved.</p>
        </div>
    </div>
</footer>
