<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            ['city' => 'Delhi NCR', 'car_count' => 15420, 'is_featured' => true, 'sort_order' => 1],
            ['city' => 'Mumbai', 'car_count' => 12890, 'is_featured' => true, 'sort_order' => 2],
            ['city' => 'Bangalore', 'car_count' => 10560, 'is_featured' => true, 'sort_order' => 3],
            ['city' => 'Chennai', 'car_count' => 8920, 'is_featured' => true, 'sort_order' => 4],
            ['city' => 'Hyderabad', 'car_count' => 7840, 'is_featured' => true, 'sort_order' => 5],
            ['city' => 'Pune', 'car_count' => 6720, 'is_featured' => false, 'sort_order' => 6],
            ['city' => 'Kolkata', 'car_count' => 5890, 'is_featured' => false, 'sort_order' => 7],
            ['city' => 'Ahmedabad', 'car_count' => 4560, 'is_featured' => false, 'sort_order' => 8],
            ['city' => 'Jaipur', 'car_count' => 3420, 'is_featured' => false, 'sort_order' => 9],
            ['city' => 'Lucknow', 'car_count' => 2890, 'is_featured' => false, 'sort_order' => 10],
        ];

        foreach ($locations as $location) {
            Location::create(array_merge($location, ['is_active' => true]));
        }
    }
}
