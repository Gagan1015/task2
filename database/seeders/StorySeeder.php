<?php

namespace Database\Seeders;

use App\Models\Story;
use Illuminate\Database\Seeder;

class StorySeeder extends Seeder
{
    public function run(): void
    {
        $stories = [
            ['title' => 'The All-New Tayron Is Here!', 'published_date' => now()->subDays(2), 'link' => '#', 'sort_order' => 1],
            ['title' => 'Electric Revolution: Top EVs of 2025', 'published_date' => now()->subDays(5), 'link' => '#', 'sort_order' => 2],
            ['title' => 'SUV vs Sedan: Which One For You?', 'published_date' => now()->subDays(7), 'link' => '#', 'sort_order' => 3],
            ['title' => 'Road Trip Essentials Guide', 'published_date' => now()->subDays(10), 'link' => '#', 'sort_order' => 4],
            ['title' => 'Budget Cars Under 10 Lakh', 'published_date' => now()->subDays(12), 'link' => '#', 'sort_order' => 5],
            ['title' => 'Car Maintenance Tips 101', 'published_date' => now()->subDays(15), 'link' => '#', 'sort_order' => 6],
        ];

        foreach ($stories as $story) {
            Story::create(array_merge($story, ['image' => '', 'is_active' => true]));
        }
    }
}
