<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_vendor_can_create_product_and_code_is_generated(): void
    {
        $vendor = User::factory()->create(['role' => 'vendor']);
        $service = new ProductService(new ProductRepository());

        $product = $service->create($vendor, [
            'name' => 'Test Product',
            'description' => 'Desc',
            'price' => 123.45,
        ]);

        $this->assertNotNull($product->id);
        $this->assertNotEmpty($product->code);
        $this->assertEquals('pending', $product->status);
        $this->assertEquals($vendor->id, $product->user_id);
    }
}
