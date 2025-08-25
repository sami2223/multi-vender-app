<?php

namespace App\Services;

use App\Events\ProductCreated;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductService
{
    public function __construct(private ProductRepository $repo) {}

    public function create(User $vendor, array $data): Product
    {
        if ($vendor->role !== 'vendor') {
            throw ValidationException::withMessages(['user' => 'Only vendors can create products.']);
        }

        return DB::transaction(function () use ($vendor, $data) {
            $product = $this->repo->create([
                'user_id' => $vendor->id,
                'code' => generateProductCode(),
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'price' => $data['price'] ?? 0,
                'status' => 'pending',
            ]);

            ProductCreated::dispatch($product);
            return $product;
        });
    }

    public function update(User $user, Product $product, array $data): Product
    {
        if (!($user->role === 'admin' || $product->user_id === $user->id)) {
            abort(403);
        }
        $this->repo->update($product, $data);
        return $product->refresh();
    }

    public function delete(User $user, Product $product): void
    {
        if (!($user->role === 'admin' || $product->user_id === $user->id)) {
            abort(403);
        }
        $this->repo->delete($product);
    }

    public function setApproval(User $admin, Product $product, bool $approve): Product
    {
        if ($admin->role !== 'admin') {
            abort(403);
        }
        $product->status = $approve ? 'approved' : 'rejected';
        $product->approved_at = $approve ? now() : null;
        $product->save();
        return $product;
    }
}
