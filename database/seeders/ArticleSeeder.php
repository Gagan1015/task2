<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();
        $authorId = $admin ? $admin->id : 1;

        $articles = [
            [
                'title' => 'Top 10 Cars Under 15 Lakh in 2025',
                'excerpt' => 'Looking for the best cars within budget? Here are our top picks for 2025.',
                'category' => 'Buying Guide',
                'is_featured' => true,
                'views' => 12450,
            ],
            [
                'title' => 'Electric Cars vs Petrol Cars: Complete Comparison',
                'excerpt' => 'A detailed analysis of running costs, maintenance, and performance.',
                'category' => 'Comparison',
                'is_featured' => true,
                'views' => 8920,
            ],
            [
                'title' => 'New Tata Curvv Launch: Everything You Need to Know',
                'excerpt' => 'Tata Motors unveils the revolutionary Curvv coupe-SUV.',
                'category' => 'News',
                'is_featured' => false,
                'views' => 6780,
            ],
            [
                'title' => '5 Essential Car Maintenance Tips for Monsoon',
                'excerpt' => 'Keep your car running smoothly during the rainy season with these tips.',
                'category' => 'Tips',
                'is_featured' => false,
                'views' => 4560,
            ],
            [
                'title' => 'Hyundai Creta vs Kia Seltos: Which SUV Should You Buy?',
                'excerpt' => 'A head-to-head comparison of two popular compact SUVs.',
                'category' => 'Comparison',
                'is_featured' => false,
                'views' => 9870,
            ],
            [
                'title' => 'First Drive: Mercedes EQS Electric Luxury',
                'excerpt' => 'We take the flagship electric Mercedes for a spin.',
                'category' => 'Reviews',
                'is_featured' => true,
                'views' => 3420,
            ],
        ];

        foreach ($articles as $article) {
            Article::create(array_merge($article, [
                'slug' => Str::slug($article['title']),
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'author_id' => $authorId,
                'is_active' => true,
                'published_at' => now()->subDays(rand(1, 30)),
            ]));
        }
    }
}
