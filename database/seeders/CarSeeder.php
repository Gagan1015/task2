<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            // Most Seen
            ['name' => 'Honda City', 'price' => '₹12.5 - 15.8 Lakh', 'category' => 'sedan', 'listing_type' => 'most_seen', 'tag' => 'NEW', 'sort_order' => 1],
            ['name' => 'Hyundai Creta', 'price' => '₹11.0 - 20.0 Lakh', 'category' => 'suv', 'listing_type' => 'most_seen', 'tag' => 'POPULAR', 'sort_order' => 2],
            ['name' => 'Maruti Swift', 'price' => '₹6.5 - 9.5 Lakh', 'category' => 'hatchback', 'listing_type' => 'most_seen', 'sort_order' => 3],
            ['name' => 'Tata Nexon', 'price' => '₹8.0 - 14.0 Lakh', 'category' => 'suv', 'listing_type' => 'most_seen', 'sort_order' => 4],
            ['name' => 'Kia Seltos', 'price' => '₹10.9 - 20.0 Lakh', 'category' => 'suv', 'listing_type' => 'most_seen', 'sort_order' => 5],
            
            // Electric
            ['name' => 'Tata Nexon EV', 'price' => '₹14.5 - 19.5 Lakh', 'category' => 'electric', 'listing_type' => 'electric', 'tag' => 'TOP SELLER', 'sort_order' => 1],
            ['name' => 'MG ZS EV', 'price' => '₹22.0 - 26.0 Lakh', 'category' => 'electric', 'listing_type' => 'electric', 'sort_order' => 2],
            ['name' => 'Hyundai Ioniq 5', 'price' => '₹45.0 - 48.0 Lakh', 'category' => 'electric', 'listing_type' => 'electric', 'tag' => 'PREMIUM', 'sort_order' => 3],
            ['name' => 'Kia EV6', 'price' => '₹60.0 - 65.0 Lakh', 'category' => 'electric', 'listing_type' => 'electric', 'sort_order' => 4],
            
            // Upcoming
            ['name' => 'Maruti eVitara', 'price' => '₹15.0 - 20.0 Lakh*', 'category' => 'electric', 'listing_type' => 'upcoming', 'is_upcoming' => true, 'tag' => 'COMING SOON', 'sort_order' => 1],
            ['name' => 'Toyota Camry 2025', 'price' => '₹45.0 - 48.0 Lakh*', 'category' => 'sedan', 'listing_type' => 'upcoming', 'is_upcoming' => true, 'sort_order' => 2],
            ['name' => 'Hyundai Creta EV', 'price' => '₹18.0 - 22.0 Lakh*', 'category' => 'electric', 'listing_type' => 'upcoming', 'is_upcoming' => true, 'sort_order' => 3],
            
            // Used
            ['name' => 'Honda City 2020', 'price' => '₹8.5 - 10.0 Lakh', 'category' => 'sedan', 'listing_type' => 'used', 'year' => 2020, 'sort_order' => 1],
            ['name' => 'Maruti Dzire 2019', 'price' => '₹5.5 - 7.0 Lakh', 'category' => 'sedan', 'listing_type' => 'used', 'year' => 2019, 'sort_order' => 2],
            ['name' => 'Hyundai i20 2021', 'price' => '₹7.0 - 9.0 Lakh', 'category' => 'hatchback', 'listing_type' => 'used', 'year' => 2021, 'sort_order' => 3],
        ];

        foreach ($cars as $car) {
            Car::create(array_merge($car, ['is_active' => true]));
        }
    }
}
