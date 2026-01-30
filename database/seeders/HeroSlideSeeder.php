<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Volkswagen Tayron R-line',
                'subtitle' => 'The Bigger Version Of The Tiguan!',
                'tag' => 'UNVEILED',
                'button_text' => 'Know More',
                'button_link' => '#',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'New Honda Amaze',
                'subtitle' => 'Modern Sedan For The Modern Family',
                'tag' => 'NEW LAUNCH',
                'button_text' => 'Explore',
                'button_link' => '#',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Tesla Model 3',
                'subtitle' => 'The Future Is Electric',
                'tag' => 'ELECTRIC',
                'button_text' => 'Learn More',
                'button_link' => '#',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
