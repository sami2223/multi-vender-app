<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@example.com'], [
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $vendor = User::firstOrCreate(['email' => 'vendor@example.com'], [
            'name' => 'Vendor One',
            'password' => Hash::make('password'),
            'role' => 'vendor',
        ]);

        Product::updateOrCreate(['code' => 'PRD-'.now()->format('Y').'-0001'], [
            'user_id' => $vendor->id,
            'name' => 'Blue Mug',
            'description' => 'Ceramic mug',
            'price' => 9.99,
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        Product::updateOrCreate(['code' => 'PRD-'.now()->format('Y').'-0002'], [
            'user_id' => $vendor->id,
            'name' => 'Green T-Shirt',
            'description' => 'Cotton tee',
            'price' => 19.99,
            'status' => 'pending',
        ]);
    }
}
