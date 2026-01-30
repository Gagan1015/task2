<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Car;
use App\Models\HeroSlide;
use App\Models\Location;
use App\Models\NavLink;
use App\Models\SiteSetting;
use App\Models\Story;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $data = [
            'mostSeenCars' => $this->getMostSeenCars(),
            'electricCars' => $this->getElectricCars(),
            'upcomingCars' => $this->getUpcomingCars(),
            'brands' => $this->getBrands(),
            'stories' => $this->getStories(),
            'locations' => $this->getLocations(),
            'news' => $this->getNews(),
            'slides' => $this->getHeroSlides(),
            'navLinks' => $this->getNavLinks(),
            'siteName' => SiteSetting::get('site_name', 'CarDealer'),
            'comparisonCars' => $this->getComparisonCars(),
        ];

        return view('landing', $data);
    }

    /**
     * Get most seen cars data.
     */
    private function getMostSeenCars(): array
    {
        $cars = Car::active()->byListingType('most_seen')->ordered()->limit(8)->get();
        
        if ($cars->isEmpty()) {
            // Fallback to static data if database is empty
            return $this->getStaticMostSeenCars();
        }

        return $cars->map(fn($car) => [
            'id' => (string) $car->id,
            'name' => $car->name,
            'price' => $car->price,
            'image' => imageUrl($car->image) ?: 'https://images.unsplash.com/photo-1623962570477-d079d3436034?q=80&w=600',
            'category' => $car->category,
            'tag' => $car->tag,
            'isUpcoming' => $car->is_upcoming,
        ])->toArray();
    }

    /**
     * Get electric cars data.
     */
    private function getElectricCars(): array
    {
        $cars = Car::active()->byListingType('electric')->ordered()->limit(8)->get();
        
        if ($cars->isEmpty()) {
            return $this->getStaticElectricCars();
        }

        return $cars->map(fn($car) => [
            'id' => (string) $car->id,
            'name' => $car->name,
            'price' => $car->price,
            'image' => imageUrl($car->image) ?: 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=600',
            'category' => $car->category,
            'tag' => $car->tag ?: 'Electric',
            'isUpcoming' => $car->is_upcoming,
        ])->toArray();
    }

    /**
     * Get upcoming cars data.
     */
    private function getUpcomingCars(): array
    {
        $cars = Car::active()->byListingType('upcoming')->ordered()->limit(8)->get();
        
        if ($cars->isEmpty()) {
            return $this->getStaticUpcomingCars();
        }

        return $cars->map(fn($car) => [
            'id' => (string) $car->id,
            'name' => $car->name,
            'price' => $car->price,
            'image' => imageUrl($car->image) ?: 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?q=80&w=600',
            'category' => $car->category,
            'tag' => $car->tag,
            'isUpcoming' => true,
        ])->toArray();
    }

    /**
     * Get brands data.
     */
    private function getBrands(): array
    {
        $brands = Brand::active()->ordered()->limit(12)->get();
        
        if ($brands->isEmpty()) {
            return $this->getStaticBrands();
        }

        return $brands->map(fn($brand) => [
            'id' => (string) $brand->id,
            'name' => $brand->name,
            'logo' => imageUrl($brand->logo) ?: $brand->logo_text ?: strtoupper(substr($brand->name, 0, 1)),
        ])->toArray();
    }

    /**
     * Get stories data.
     */
    private function getStories(): array
    {
        $stories = Story::active()->ordered()->limit(6)->get();
        
        if ($stories->isEmpty()) {
            return $this->getStaticStories();
        }

        return $stories->map(fn($story) => [
            'id' => (string) $story->id,
            'title' => $story->title,
            'image' => imageUrl($story->image) ?: 'https://images.unsplash.com/photo-1600712242805-5f79949501d2?q=80&w=800',
            'date' => $story->formattedDate,
        ])->toArray();
    }

    /**
     * Get locations data.
     */
    private function getLocations(): array
    {
        $locations = Location::active()->featured()->ordered()->limit(6)->get();
        
        if ($locations->isEmpty()) {
            return $this->getStaticLocations();
        }

        return $locations->map(fn($loc) => [
            'id' => (string) $loc->id,
            'city' => $loc->city,
            'count' => $loc->car_count,
        ])->toArray();
    }

    /**
     * Get news data.
     */
    private function getNews(): array
    {
        $articles = Article::published()->featured()->latest()->limit(6)->get();
        
        if ($articles->isEmpty()) {
            $articles = Article::published()->latest()->limit(6)->get();
        }
        
        if ($articles->isEmpty()) {
            return $this->getStaticNews();
        }

        return $articles->map(fn($article) => [
            'id' => (string) $article->id,
            'title' => $article->title,
            'excerpt' => $article->excerpt,
            'date' => $article->relativeDate,
            'views' => $article->formattedViews,
            'image' => imageUrl($article->image) ?: 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?q=80&w=600',
            'category' => $article->category,
        ])->toArray();
    }

    /**
     * Get hero slides data.
     */
    private function getHeroSlides(): array
    {
        $slides = HeroSlide::active()->ordered()->limit(5)->get();
        
        if ($slides->isEmpty()) {
            return $this->getStaticHeroSlides();
        }

        return $slides->map(fn($slide) => [
            'id' => $slide->id,
            'title' => $slide->title,
            'tag' => $slide->tag,
            'subtitle' => $slide->subtitle,
            'bgImage' => imageUrl($slide->background_image) ?: 'https://images.unsplash.com/photo-1533158307587-828f0a76ef93?q=80&w=2000',
            'buttonText' => $slide->button_text ?? 'Know More',
            'buttonLink' => $slide->button_link ?? '#',
        ])->toArray();
    }

    /**
     * Get navigation links.
     */
    private function getNavLinks(): array
    {
        $links = NavLink::whereNull('parent_id')->active()->ordered()->with('children')->get();
        
        return $links->map(fn($link) => [
            'label' => $link->label,
            'url' => $link->url,
            'target' => $link->target,
            'children' => $link->children->map(fn($child) => [
                'label' => $child->label,
                'url' => $child->url,
                'target' => $child->target,
            ])->toArray(),
        ])->toArray();
    }

    /**
     * Get comparison cars (pairs of cars for comparison).
     */
    private function getComparisonCars(): array
    {
        // Get 6 cars for 3 comparison pairs
        $cars = Car::active()->ordered()->limit(6)->get();
        
        if ($cars->count() < 2) {
            return $this->getStaticComparisonCars();
        }

        $comparisons = [];
        for ($i = 0; $i < $cars->count() - 1; $i += 2) {
            $carA = $cars[$i];
            $carB = $cars[$i + 1] ?? $cars[0];
            
            $comparisons[] = [
                'carA' => [
                    'name' => $carA->name,
                    'price' => $carA->price,
                    'image' => imageUrl($carA->image) ?: 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=400',
                ],
                'carB' => [
                    'name' => $carB->name,
                    'price' => $carB->price,
                    'image' => imageUrl($carB->image) ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400',
                ],
            ];
        }

        return array_slice($comparisons, 0, 3);
    }

    // ============================================
    // STATIC FALLBACK DATA (when database is empty)
    // ============================================

    private function getStaticMostSeenCars(): array
    {
        return [
            ['id' => '1', 'name' => 'Yaris Cross', 'price' => '$76-95k/month', 'image' => 'https://images.unsplash.com/photo-1623962570477-d079d3436034?q=80&w=600', 'category' => 'suv', 'tag' => null, 'isUpcoming' => false],
            ['id' => '2', 'name' => 'Yaris Ativ', 'price' => '$88-107k/month', 'image' => 'https://images.unsplash.com/photo-1625937989508-2e06c11648a7?q=80&w=600', 'category' => 'sedan', 'tag' => null, 'isUpcoming' => false],
            ['id' => '3', 'name' => 'Avanti Urbane', 'price' => '$86-104k/month', 'image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=600', 'category' => 'hatchback', 'tag' => null, 'isUpcoming' => false],
            ['id' => '4', 'name' => 'Xc Weey', 'price' => '$82-99k/month', 'image' => 'https://images.unsplash.com/photo-1616422285623-13ff0162193c?q=80&w=600', 'category' => 'suv', 'tag' => null, 'isUpcoming' => false],
        ];
    }

    private function getStaticElectricCars(): array
    {
        return [
            ['id' => 'e1', 'name' => 'Honda e', 'price' => '$92-110k/month', 'image' => 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?q=80&w=600', 'category' => 'electric', 'tag' => 'Electric', 'isUpcoming' => false],
            ['id' => 'e2', 'name' => 'MG 4 EV 64', 'price' => '$95-120k/month', 'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=600', 'category' => 'electric', 'tag' => 'Electric', 'isUpcoming' => false],
            ['id' => 'e3', 'name' => 'Elroq Laurin', 'price' => '$105-130k/month', 'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?q=80&w=600', 'category' => 'electric', 'tag' => 'Electric', 'isUpcoming' => false],
            ['id' => 'e4', 'name' => 'Zoe Iconic', 'price' => '$78-90k/month', 'image' => 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?q=80&w=600', 'category' => 'electric', 'tag' => 'Electric', 'isUpcoming' => false],
        ];
    }

    private function getStaticUpcomingCars(): array
    {
        return [
            ['id' => 'u1', 'name' => 'Cybertruck Future', 'price' => 'Coming Soon', 'image' => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?q=80&w=600', 'category' => 'suv', 'tag' => null, 'isUpcoming' => true],
            ['id' => 'u2', 'name' => 'Skyline Prototype', 'price' => 'Launch: Nov 2024', 'image' => 'https://images.unsplash.com/photo-1617788138017-80ad40651399?q=80&w=600', 'category' => 'sedan', 'tag' => null, 'isUpcoming' => true],
            ['id' => 'u3', 'name' => 'Vision 74', 'price' => 'Coming Soon', 'image' => 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?q=80&w=600', 'category' => 'luxury', 'tag' => null, 'isUpcoming' => true],
            ['id' => 'u4', 'name' => 'Project Titan', 'price' => 'Secret Reveal', 'image' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=600', 'category' => 'electric', 'tag' => null, 'isUpcoming' => true],
        ];
    }

    private function getStaticBrands(): array
    {
        return [
            ['id' => '1', 'name' => 'Suzuki', 'logo' => 'S'],
            ['id' => '2', 'name' => 'Tata', 'logo' => 'T'],
            ['id' => '3', 'name' => 'KIA', 'logo' => 'K'],
            ['id' => '4', 'name' => 'Toyota', 'logo' => 'TY'],
            ['id' => '5', 'name' => 'Hyundai', 'logo' => 'H'],
            ['id' => '6', 'name' => 'Wuling', 'logo' => 'W'],
        ];
    }

    private function getStaticStories(): array
    {
        return [
            ['id' => '1', 'title' => 'Top Modified Cars in 2023', 'image' => 'https://images.unsplash.com/photo-1600712242805-5f79949501d2?q=80&w=800', 'date' => 'Oct 12, 2023'],
            ['id' => '2', 'title' => 'Top Luxury Cars to Buy in Dubai', 'image' => 'https://images.unsplash.com/photo-1503376763036-066120622c74?q=80&w=800', 'date' => 'Sep 28, 2023'],
            ['id' => '3', 'title' => 'Vintage Rally Championship', 'image' => 'https://images.unsplash.com/photo-1532581140115-3e355d1ed1de?q=80&w=800', 'date' => 'Aug 15, 2023'],
        ];
    }

    private function getStaticLocations(): array
    {
        return [
            ['id' => '1', 'city' => 'Bangalore', 'count' => 234],
            ['id' => '2', 'city' => 'Pune', 'count' => 164],
            ['id' => '3', 'city' => 'Chennai', 'count' => 134],
            ['id' => '4', 'city' => 'Delhi NCR', 'count' => 310],
            ['id' => '5', 'city' => 'Mumbai', 'count' => 189],
            ['id' => '6', 'city' => 'Hyderabad', 'count' => 156],
        ];
    }

    private function getStaticNews(): array
    {
        return [
            ['id' => '1', 'title' => '2024 SUV Buying Guide', 'excerpt' => 'Everything you need to know before buying your next family hauler.', 'date' => '2 days ago', 'views' => '1.2k', 'image' => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?q=80&w=600', 'category' => 'Guide'],
            ['id' => '2', 'title' => 'Electric vs Hybrid: Who Wins?', 'excerpt' => 'A comprehensive breakdown of cost, range, and maintenance.', 'date' => '5 days ago', 'views' => '3.4k', 'image' => 'https://images.unsplash.com/photo-1593941707874-ef25b8b4a92b?q=80&w=600', 'category' => 'Review'],
            ['id' => '3', 'title' => 'Safety Ratings Explained', 'excerpt' => 'Decoding NCAP ratings and what they actually mean for you.', 'date' => '1 week ago', 'views' => '800', 'image' => 'https://images.unsplash.com/photo-1485291571150-772bcfc10da5?q=80&w=600', 'category' => 'Safety'],
        ];
    }

    private function getStaticHeroSlides(): array
    {
        return [
            ['id' => 1, 'title' => 'Volkswagen Tayron R-line', 'tag' => 'UNVEILED', 'subtitle' => 'The Bigger Version Of The Tiguan!', 'bgImage' => 'https://images.unsplash.com/photo-1533158307587-828f0a76ef93?q=80&w=2000', 'buttonText' => 'Know More', 'buttonLink' => '#'],
            ['id' => 2, 'title' => 'Renault Duster Unveiled', 'tag' => 'LATEST', 'subtitle' => 'The Legend Returns with More Power!', 'bgImage' => 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=2000', 'buttonText' => 'Know More', 'buttonLink' => '#'],
            ['id' => 3, 'title' => 'Skoda Kushaq', 'tag' => 'POPULAR', 'subtitle' => 'King of the Urban Jungle', 'bgImage' => 'https://images.unsplash.com/photo-1502877338535-766e1452684a?q=80&w=2000', 'buttonText' => 'Know More', 'buttonLink' => '#'],
        ];
    }

    private function getStaticComparisonCars(): array
    {
        return [
            [
                'carA' => ['name' => 'Toyota Fortuner', 'price' => '₹32-50 Lakh', 'image' => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=400'],
                'carB' => ['name' => 'Ford Endeavour', 'price' => '₹34-52 Lakh', 'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400'],
            ],
            [
                'carA' => ['name' => 'Hyundai Creta', 'price' => '₹11-20 Lakh', 'image' => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=400'],
                'carB' => ['name' => 'Kia Seltos', 'price' => '₹10-19 Lakh', 'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?q=80&w=400'],
            ],
            [
                'carA' => ['name' => 'Tata Nexon', 'price' => '₹8-14 Lakh', 'image' => 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?q=80&w=400'],
                'carB' => ['name' => 'Maruti Brezza', 'price' => '₹8-14 Lakh', 'image' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?q=80&w=400'],
            ],
        ];
    }
}
