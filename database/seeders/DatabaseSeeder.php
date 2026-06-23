<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Product::create([
            'description' => 'Product 1',
            'price' => 10.00,
            'image' => 'game.png',
        ]);

        Product::create([
            'description' => 'Product 2',
            'price' => 20.00,
            'image' => 'safe.png',
        ]);
    }
}
