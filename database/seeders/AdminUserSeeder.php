<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cardealer.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@cardealer.com',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
