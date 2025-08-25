<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
  public function __construct(private ProductService $service) {}

  public function index(Request $request): View
  {
    $products = $this->service->listForVendor($request->user());
    return view('products.index', compact('products'));
  }

  public function store(Request $request): RedirectResponse
  {
    $validated = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'description' => ['nullable', 'string'],
      'price' => ['required', 'numeric', 'min:0'],
    ]);

    $this->service->createForVendor($request->user(), $validated);

    return back()->with('status', 'Product created and pending approval.');
  }

  public function update(Request $request, Product $product): RedirectResponse
  {
    $validated = $request->validate([
      'name' => ['sometimes', 'string', 'max:255'],
      'description' => ['nullable', 'string'],
      'price' => ['sometimes', 'numeric', 'min:0'],
    ]);

    $this->service->updateForVendor($request->user(), $product, $validated);

    return back()->with('status', 'Product updated and pending approval.');
  }

  public function destroy(Request $request, Product $product): RedirectResponse
  {
    $this->service->deleteForVendor($request->user(), $product);
    return back()->with('status', 'Product deleted.');
  }
}
