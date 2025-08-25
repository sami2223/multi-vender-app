<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin','vendor']);
    }

    public function view(User $user, Product $product): bool
    {
        return $user->role === 'admin' || $product->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'vendor';
    }

    public function update(User $user, Product $product): bool
    {
        return $user->role === 'admin' || $product->user_id === $user->id;
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin' || $product->user_id === $user->id;
    }
}

