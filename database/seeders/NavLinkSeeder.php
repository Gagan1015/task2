<?php

namespace Database\Seeders;

use App\Models\NavLink;
use Illuminate\Database\Seeder;

class NavLinkSeeder extends Seeder
{
    public function run(): void
    {
        $navLinks = [
            ['label' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['label' => 'New Cars', 'url' => '#new-cars', 'sort_order' => 2],
            ['label' => 'Used Cars', 'url' => '#used-cars', 'sort_order' => 3],
            ['label' => 'Electric', 'url' => '#electric', 'sort_order' => 4],
            ['label' => 'News', 'url' => '#news', 'sort_order' => 5],
            ['label' => 'Compare', 'url' => '#compare', 'sort_order' => 6],
            ['label' => 'Sell Car', 'url' => '#sell', 'sort_order' => 7],
        ];

        foreach ($navLinks as $link) {
            NavLink::create(array_merge($link, ['is_active' => true, 'target' => '_self']));
        }
    }
}
