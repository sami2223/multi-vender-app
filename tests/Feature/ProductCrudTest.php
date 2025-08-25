<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendor_listing_requires_auth(): void
    {
        $this->get('/products')->assertRedirect('/login');
    }

    public function test_vendor_can_create_and_view_own_products(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $this->actingAs($vendor);

        $response = $this->post('/products', [
            'name' => 'Feature Product',
            'price' => 10.00,
            'description' => 'Nice item',
        ]);

        $response->assertRedirect('/products');

        $this->get('/products')
            ->assertSee('Feature Product')
            ->assertSee('Pending');
    }
}
