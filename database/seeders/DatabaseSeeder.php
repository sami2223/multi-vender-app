<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $admin = User::query()->updateOrCreate(
      ['email' => 'admin@example.com'],
      [
        'name' => 'Admin',
        'password' => Hash::make('password'),
        'role' => 'admin',
      ]
    );

    $vendor = User::query()->updateOrCreate(
      ['email' => 'vendor@example.com'],
      [
        'name' => 'Vendor One',
        'password' => Hash::make('password'),
        'role' => 'vendor',
      ]
    );

    Product::query()->create([
      'user_id' => $vendor->id,
      'code' => generateProductCode(),
      'name' => 'Sample Product A',
      'description' => 'First sample product',
      'price' => 19.99,
      'status' => 'approved',
    ]);

    Product::query()->create([
      'user_id' => $vendor->id,
      'code' => generateProductCode(),
      'name' => 'Sample Product B',
      'description' => 'Second sample product',
      'price' => 29.99,
      'status' => 'pending',
    ]);
  }
}
