@extends('layouts.app')

@section('title', 'CarDealer - Find Your Dream Car')
@section('description', 'The most trusted marketplace to buy, sell, and rent vehicles. Find new cars, used cars, electric vehicles, and upcoming car launches.')

@section('content')
    <div class="min-h-screen flex flex-col font-sans text-gray-800">
        
        {{-- Header --}}
        <x-header />
        
        {{-- Main Content --}}
        <main>
            {{-- Hero Section --}}
            <x-hero :slides="$slides" />

            {{-- Section 1: Most Seen Cars --}}
            @include('sections.most-seen-cars')

            {{-- Section 2: Electric Cars --}}
            @include('sections.electric-cars')

            {{-- Section 3: Upcoming Cars --}}
            @include('sections.upcoming-cars')

            {{-- Section 4: Trusted Used Cars --}}
            @include('sections.trusted-used-cars')

            {{-- Section 5: Popular Brands --}}
            @include('sections.popular-brands')

            {{-- Section 6: Visual Stories --}}
            @include('sections.visual-stories')

            {{-- Section 7: Comparison Tool --}}
            @include('sections.comparison-tool')

            {{-- Section 8: Nearby Locations --}}
            @include('sections.nearby-locations')

            {{-- Section 9: News --}}
            @include('sections.news')

            {{-- Section 10: Educational --}}
            @include('sections.educational')
        </main>

        {{-- Footer --}}
        <x-footer />
        
    </div>
@endsection
