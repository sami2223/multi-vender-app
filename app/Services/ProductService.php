<?php

namespace App\Services;

use App\Events\ProductCreated;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
  public function listForVendor(User $vendor): LengthAwarePaginator
  {
    return Product::query()
      ->where('user_id', $vendor->id)
      ->orderByDesc('id')
      ->paginate(10);
  }

  public function listPending(): LengthAwarePaginator
  {
    return Product::query()
      ->where('status', 'pending')
      ->orderBy('created_at')
      ->paginate(10);
  }

  public function createForVendor(User $vendor, array $data): Product
  {
    return DB::transaction(function () use ($vendor, $data) {
      $product = new Product();
      $product->fill([
        'name' => $data['name'],
        'description' => $data['description'] ?? null,
        'price' => $data['price'],
        'code' => generateProductCode(),
        'status' => 'pending',
      ]);
      $product->user_id = $vendor->id;
      $product->save();

      event(new ProductCreated($product));

      return $product;
    });
  }

  public function updateForVendor(User $vendor, Product $product, array $data): Product
  {
    if ($product->user_id !== $vendor->id) {
      abort(403);
    }

    $product->fill([
      'name' => $data['name'] ?? $product->name,
      'description' => $data['description'] ?? $product->description,
      'price' => $data['price'] ?? $product->price,
    ]);
    $product->status = 'pending';
    $product->save();

    return $product;
  }

  public function deleteForVendor(User $vendor, Product $product): void
  {
    if ($product->user_id !== $vendor->id) {
      abort(403);
    }
    $product->delete();
  }

  public function approve(Product $product): Product
  {
    $product->status = 'approved';
    $product->save();
    return $product;
  }

  public function reject(Product $product): Product
  {
    $product->status = 'rejected';
    $product->save();
    return $product;
  }
}
