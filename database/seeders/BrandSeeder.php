<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Toyota', 'logo_text' => 'T', 'sort_order' => 1],
            ['name' => 'Honda', 'logo_text' => 'H', 'sort_order' => 2],
            ['name' => 'Hyundai', 'logo_text' => 'H', 'sort_order' => 3],
            ['name' => 'Maruti', 'logo_text' => 'M', 'sort_order' => 4],
            ['name' => 'Tata', 'logo_text' => 'T', 'sort_order' => 5],
            ['name' => 'Kia', 'logo_text' => 'K', 'sort_order' => 6],
            ['name' => 'BMW', 'logo_text' => 'BMW', 'sort_order' => 7],
            ['name' => 'Mercedes', 'logo_text' => 'MB', 'sort_order' => 8],
            ['name' => 'Audi', 'logo_text' => 'A', 'sort_order' => 9],
            ['name' => 'Volkswagen', 'logo_text' => 'VW', 'sort_order' => 10],
            ['name' => 'Tesla', 'logo_text' => 'T', 'sort_order' => 11],
            ['name' => 'MG', 'logo_text' => 'MG', 'sort_order' => 12],
        ];

        foreach ($brands as $brand) {
            Brand::create(array_merge($brand, ['is_active' => true]));
        }
    }
}
