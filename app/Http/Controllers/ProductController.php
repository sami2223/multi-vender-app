<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index()
    {
        $products = Product::mine(auth()->user())->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(StoreProductRequest $request)
    {
        $this->service->create(auth()->user(), $request->validated());
        return redirect()->route('products.index')->with('status', 'Product submitted for approval.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('products.edit', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);
        $this->service->update(auth()->user(), $product, $request->validated());
        return back()->with('status', 'Updated.');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $this->service->delete(auth()->user(), $product);
        return back()->with('status', 'Deleted.');
    }
}
